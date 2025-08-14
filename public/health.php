<?php
/**
 * Health check endpoint para Render
 * Rochas Energy - Health Check
 */

// Configurar headers
header('Content-Type: application/json');
header('Cache-Control: no-cache, no-store, must-revalidate');

// Verificar que PHP está funcionando
$php_ok = function_exists('phpversion');

// Verificar que Apache está funcionando
$apache_ok = isset($_SERVER['SERVER_SOFTWARE']) && strpos($_SERVER['SERVER_SOFTWARE'], 'Apache') !== false;

// Verificar que el directorio public es accesible
$public_ok = is_readable('/var/www/html/public');

// Verificar que los directorios necesarios existen
$logs_ok = is_dir('/var/www/html/logs');
$admin_ok = is_dir('/var/www/html/admin');

// Verificar que SQLite está disponible
$sqlite_ok = extension_loaded('pdo_sqlite');

// Estado general
$status = $php_ok && $apache_ok && $public_ok && $logs_ok && $admin_ok && $sqlite_ok ? 'healthy' : 'unhealthy';

// Respuesta
$response = [
    'status' => $status,
    'timestamp' => date('Y-m-d H:i:s'),
    'checks' => [
        'php' => $php_ok,
        'apache' => $apache_ok,
        'public_directory' => $public_ok,
        'logs_directory' => $logs_ok,
        'admin_directory' => $admin_ok,
        'sqlite_extension' => $sqlite_ok
    ],
    'version' => [
        'php' => phpversion(),
        'apache' => $_SERVER['SERVER_SOFTWARE'] ?? 'unknown'
    ],
    'environment' => getenv('ENVIRONMENT') ?: 'unknown'
];

// Código de estado HTTP
http_response_code($status === 'healthy' ? 200 : 503);

// Enviar respuesta JSON
echo json_encode($response, JSON_PRETTY_PRINT);
?>
