<?php
/**
 * Sistema de logging y monitoreo de seguridad
 * Rochas Energy - Sistema de logs avanzado
 */

// Configuración de logging
$logging_config = [
    'enabled' => true,
    'log_directory' => (getenv("RENDER") !== false) ? "/opt/render/project/src/logs" : "logs",
    'max_log_size' => 10 * 1024 * 1024, // 10MB
    'max_log_files' => 5,
    'log_levels' => [
        'ERROR' => 0,
        'WARNING' => 1,
        'INFO' => 2,
        'DEBUG' => 3
    ],
    'current_level' => 'INFO', // Cambiar a 'DEBUG' en desarrollo
    
    // Configuración de archivos de log
    'log_files' => [
        'security' => 'security.log',
        'errors' => 'errors.log',
        'access' => 'access.log',
        'email' => 'email.log',
        'performance' => 'performance.log'
    ],
    
    // Configuración de alertas
    'alerts' => [
        'enabled' => true,
        'email_alerts' => false, // Habilitar cuando se configure email
        'alert_threshold' => 10, // Número de errores antes de alertar
        'alert_window' => 3600 // Ventana de tiempo en segundos
    ]
];

/**
 * Función principal de logging
 */
function logMessage($message, $level = 'INFO', $category = 'general', $context = []) {
    global $logging_config;
    
    if (!$logging_config['enabled']) {
        return false;
    }
    
    // Verificar nivel de log
    if ($logging_config['log_levels'][$level] > $logging_config['log_levels'][$logging_config['current_level']]) {
        return false;
    }
    
    // Crear directorio de logs si no existe
    $log_dir = $logging_config['log_directory'];
    if (!is_dir($log_dir)) {
        if (!mkdir($log_dir, 0755, true)) {
            // Si no se puede crear el directorio, usar un directorio temporal
            $log_dir = sys_get_temp_dir() . '/rochas_logs';
            if (!is_dir($log_dir)) {
                mkdir($log_dir, 0755, true);
            }
        }
    }
    
    // Verificar permisos de escritura
    if (!is_writable($log_dir)) {
        // Si no es escribible, usar directorio temporal
        $log_dir = sys_get_temp_dir() . '/rochas_logs';
        if (!is_dir($log_dir)) {
            mkdir($log_dir, 0755, true);
        }
    }
    
    // Determinar archivo de log
    $log_file = $logging_config['log_files'][$category] ?? 'general.log';
    $log_path = $log_dir . '/' . $log_file;
    
    // Crear entrada de log
    $timestamp = date('Y-m-d H:i:s');
    $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
    $user_agent = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';
    $request_uri = $_SERVER['REQUEST_URI'] ?? 'unknown';
    $method = $_SERVER['REQUEST_METHOD'] ?? 'unknown';
    
    $log_entry = [
        'timestamp' => $timestamp,
        'level' => $level,
        'message' => $message,
        'ip' => $ip,
        'user_agent' => $user_agent,
        'request_uri' => $request_uri,
        'method' => $method,
        'context' => $context
    ];
    
    $log_line = json_encode($log_entry) . "\n";
    
    // Escribir al archivo de log
    if (file_put_contents($log_path, $log_line, FILE_APPEND | LOCK_EX) === false) {
        error_log("Error writing to log file: $log_path");
        return false;
    }
    
    // Rotar logs si es necesario
    rotateLogs($log_path);
    
    // Verificar alertas
    checkAlerts($level, $category);
    
    return true;
}

/**
 * Log de errores de seguridad
 */
function logSecurityEvent($event, $details = []) {
    $context = array_merge($details, [
        'session_id' => session_id() ?? 'none',
        'user_id' => $_SESSION['user_id'] ?? 'anonymous'
    ]);
    
    return logMessage($event, 'WARNING', 'security', $context);
}

/**
 * Log de errores de aplicación
 */
function logError($error, $context = []) {
    return logMessage($error, 'ERROR', 'errors', $context);
}

/**
 * Log de acceso
 */
function logAccess($action, $details = []) {
    return logMessage($action, 'INFO', 'access', $details);
}

/**
 * Log de emails
 */
function logEmail($action, $details = []) {
    return logMessage($action, 'INFO', 'email', $details);
}

/**
 * Log de rendimiento
 */
function logPerformance($action, $duration, $details = []) {
    $context = array_merge($details, ['duration' => $duration]);
    return logMessage($action, 'INFO', 'performance', $context);
}

/**
 * Rotar archivos de log
 */
function rotateLogs($log_path) {
    global $logging_config;
    
    if (!file_exists($log_path)) {
        return;
    }
    
    $file_size = filesize($log_path);
    if ($file_size < $logging_config['max_log_size']) {
        return;
    }
    
    // Rotar archivos existentes
    for ($i = $logging_config['max_log_files'] - 1; $i >= 1; $i--) {
        $old_file = $log_path . '.' . $i;
        $new_file = $log_path . '.' . ($i + 1);
        
        if (file_exists($old_file)) {
            if ($i == $logging_config['max_log_files'] - 1) {
                unlink($old_file);
            } else {
                rename($old_file, $new_file);
            }
        }
    }
    
    // Mover archivo actual
    rename($log_path, $log_path . '.1');
}

/**
 * Verificar alertas
 */
function checkAlerts($level, $category) {
    global $logging_config;
    
    if (!$logging_config['alerts']['enabled']) {
        return;
    }
    
    if ($level !== 'ERROR') {
        return;
    }
    
    $log_dir = $logging_config['log_directory'];
    $errors_log = $log_dir . '/' . $logging_config['log_files']['errors'];
    
    if (!file_exists($errors_log)) {
        return;
    }
    
    // Contar errores en la ventana de tiempo
    $window_start = time() - $logging_config['alerts']['alert_window'];
    $error_count = 0;
    
    $handle = fopen($errors_log, 'r');
    if ($handle) {
        while (($line = fgets($handle)) !== false) {
            $log_entry = json_decode($line, true);
            if ($log_entry && $log_entry['level'] === 'ERROR') {
                $log_time = strtotime($log_entry['timestamp']);
                if ($log_time >= $window_start) {
                    $error_count++;
                }
            }
        }
        fclose($handle);
    }
    
    // Enviar alerta si se supera el umbral
    if ($error_count >= $logging_config['alerts']['alert_threshold']) {
        sendSecurityAlert($error_count, $category);
    }
}

/**
 * Enviar alerta de seguridad
 */
function sendSecurityAlert($error_count, $category) {
    global $logging_config;
    
    if (!$logging_config['alerts']['email_alerts']) {
        return;
    }
    
    $subject = '[ALERTA] Múltiples errores detectados en Rochas Energy';
    $message = "Se han detectado $error_count errores en la categoría '$category' en la última hora.\n";
    $message .= "Revisa los logs para más detalles.\n";
    $message .= "Timestamp: " . date('Y-m-d H:i:s') . "\n";
    $message .= "IP: " . ($_SERVER['REMOTE_ADDR'] ?? 'unknown') . "\n";
    
    // Aquí se podría enviar email usando el sistema existente
    error_log("SECURITY ALERT: $message");
}

/**
 * Obtener estadísticas de logs
 */
function getLogStats($category = null, $hours = 24) {
    global $logging_config;
    
    $log_dir = $logging_config['log_directory'];
    $stats = [
        'total' => 0,
        'errors' => 0,
        'warnings' => 0,
        'info' => 0,
        'security_events' => 0
    ];
    
    $files_to_check = $category ? [$logging_config['log_files'][$category]] : array_values($logging_config['log_files']);
    
    foreach ($files_to_check as $log_file) {
        $log_path = $log_dir . '/' . $log_file;
        if (!file_exists($log_path)) {
            continue;
        }
        
        $handle = fopen($log_path, 'r');
        if ($handle) {
            $window_start = time() - ($hours * 3600);
            
            while (($line = fgets($handle)) !== false) {
                $log_entry = json_decode($line, true);
                if ($log_entry) {
                    $log_time = strtotime($log_entry['timestamp']);
                    if ($log_time >= $window_start) {
                        $stats['total']++;
                        
                        switch ($log_entry['level']) {
                            case 'ERROR':
                                $stats['errors']++;
                                break;
                            case 'WARNING':
                                $stats['warnings']++;
                                break;
                            case 'INFO':
                                $stats['info']++;
                                break;
                        }
                        
                        if ($log_file === $logging_config['log_files']['security']) {
                            $stats['security_events']++;
                        }
                    }
                }
            }
            fclose($handle);
        }
    }
    
    return $stats;
}

/**
 * Limpiar logs antiguos
 */
function cleanOldLogs($days = 30) {
    global $logging_config;
    
    $log_dir = $logging_config['log_directory'];
    if (!is_dir($log_dir)) {
        return;
    }
    
    $cutoff_time = time() - ($days * 24 * 3600);
    
    $files = glob($log_dir . '/*.log*');
    foreach ($files as $file) {
        if (filemtime($file) < $cutoff_time) {
            unlink($file);
        }
    }
}

/**
 * Función para obtener logs recientes
 */
function getRecentLogs($category = 'errors', $limit = 50) {
    global $logging_config;
    
    $log_dir = $logging_config['log_directory'];
    $log_file = $logging_config['log_files'][$category] ?? 'errors.log';
    $log_path = $log_dir . '/' . $log_file;
    
    $logs = [];
    
    if (file_exists($log_path)) {
        $lines = file($log_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $lines = array_reverse($lines); // Más recientes primero
        
        foreach (array_slice($lines, 0, $limit) as $line) {
            $log_entry = json_decode($line, true);
            if ($log_entry) {
                $logs[] = $log_entry;
            }
        }
    }
    
    return $logs;
}

// Inicializar logging automáticamente
if ($logging_config['enabled']) {
    // Log de inicio de sesión
    logAccess('Page loaded', [
        'page' => $_SERVER['REQUEST_URI'] ?? 'unknown',
        'referer' => $_SERVER['HTTP_REFERER'] ?? 'direct'
    ]);
}
?>
