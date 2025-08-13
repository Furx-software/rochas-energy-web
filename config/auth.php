<?php
/**
 * Sistema de autenticación para panel de administración
 * Rochas Energy - Autenticación con SQLite
 */

// Configuración de autenticación
$auth_config = [
    'db_path => getenv("RENDER") ? "/opt/render/project/src/admin/users.db" : "admin/users.db"',
    'session_timeout' => 3600, // 1 hora
    'max_login_attempts' => 5,
    'lockout_duration' => 900, // 15 minutos
    'password_min_length' => 8,
    'require_special_chars' => true
];

/**
 * Inicializar base de datos SQLite
 */
function initAuthDatabase() {
    global $auth_config;
    
    $db_path = $auth_config['db_path'];
    $db_dir = dirname($db_path);
    
    // Crear directorio si no existe
    if (!is_dir($db_dir)) {
        mkdir($db_dir, 0755, true);
    }
    
    try {
        $pdo = new PDO("sqlite:$db_path");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Crear tabla de usuarios si no existe
        $pdo->exec("
            CREATE TABLE IF NOT EXISTS users (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                username TEXT UNIQUE NOT NULL,
                password_hash TEXT NOT NULL,
                email TEXT,
                role TEXT DEFAULT 'admin',
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
                last_login DATETIME,
                is_active INTEGER DEFAULT 1
            )
        ");
        
        // Crear tabla de intentos de login
        $pdo->exec("
            CREATE TABLE IF NOT EXISTS login_attempts (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                username TEXT NOT NULL,
                ip_address TEXT NOT NULL,
                success INTEGER DEFAULT 0,
                timestamp DATETIME DEFAULT CURRENT_TIMESTAMP
            )
        ");
        
        // Crear usuario por defecto si no existe
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = ?");
        $stmt->execute(['admin']);
        
        if ($stmt->fetchColumn() == 0) {
            $default_password = 'admin123'; // Cambiar en producción
            $password_hash = password_hash($default_password, PASSWORD_DEFAULT);
            
            $stmt = $pdo->prepare("
                INSERT INTO users (username, password_hash, email, role) 
                VALUES (?, ?, ?, ?)
            ");
            $stmt->execute(['admin', $password_hash, 'admin@rochasenergy.com', 'admin']);
            
            error_log("Usuario por defecto creado: admin / admin123");
        }
        
        return $pdo;
        
    } catch (PDOException $e) {
        error_log("Error inicializando base de datos de autenticación: " . $e->getMessage());
        return false;
    }
}

/**
 * Obtener conexión a la base de datos
 */
function getAuthDB() {
    static $pdo = null;
    
    if ($pdo === null) {
        $pdo = initAuthDatabase();
    }
    
    return $pdo;
}

/**
 * Verificar credenciales de usuario
 */
function authenticateUser($username, $password) {
    global $auth_config;
    
    $pdo = getAuthDB();
    if (!$pdo) {
        return ['success' => false, 'message' => 'Error de base de datos'];
    }
    
    // Verificar intentos de login
    if (isUserLocked($username)) {
        return ['success' => false, 'message' => 'Cuenta bloqueada temporalmente. Intenta de nuevo en 15 minutos.'];
    }
    
    try {
        $stmt = $pdo->prepare("
            SELECT id, username, password_hash, role, is_active 
            FROM users 
            WHERE username = ? AND is_active = 1
        ");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$user) {
            logLoginAttempt($username, false);
            return ['success' => false, 'message' => 'Usuario o contraseña incorrectos'];
        }
        
        if (password_verify($password, $user['password_hash'])) {
            // Login exitoso
            logLoginAttempt($username, true);
            updateLastLogin($user['id']);
            
            // Crear sesión
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['login_time'] = time();
            
            return ['success' => true, 'user' => $user];
        } else {
            logLoginAttempt($username, false);
            return ['success' => false, 'message' => 'Usuario o contraseña incorrectos'];
        }
        
    } catch (PDOException $e) {
        error_log("Error en autenticación: " . $e->getMessage());
        return ['success' => false, 'message' => 'Error interno del servidor'];
    }
}

/**
 * Verificar si el usuario está autenticado
 */
function isAuthenticated() {
    if (!isset($_SESSION['user_id']) || !isset($_SESSION['login_time'])) {
        return false;
    }
    
    // Verificar timeout de sesión
    global $auth_config;
    if (time() - $_SESSION['login_time'] > $auth_config['session_timeout']) {
        logout();
        return false;
    }
    
    // Actualizar tiempo de sesión
    $_SESSION['login_time'] = time();
    
    return true;
}

/**
 * Verificar si el usuario tiene un rol específico
 */
function hasRole($role) {
    if (!isAuthenticated()) {
        return false;
    }
    
    return $_SESSION['role'] === $role;
}

/**
 * Cerrar sesión
 */
function logout() {
    session_unset();
    session_destroy();
    session_start();
}

/**
 * Registrar intento de login
 */
function logLoginAttempt($username, $success) {
    $pdo = getAuthDB();
    if (!$pdo) {
        return;
    }
    
    try {
        $stmt = $pdo->prepare("
            INSERT INTO login_attempts (username, ip_address, success) 
            VALUES (?, ?, ?)
        ");
        $stmt->execute([$username, $_SERVER['REMOTE_ADDR'] ?? 'unknown', $success ? 1 : 0]);
        
    } catch (PDOException $e) {
        error_log("Error registrando intento de login: " . $e->getMessage());
    }
}

/**
 * Verificar si un usuario está bloqueado
 */
function isUserLocked($username) {
    global $auth_config;
    
    $pdo = getAuthDB();
    if (!$pdo) {
        return false;
    }
    
    try {
        $stmt = $pdo->prepare("
            SELECT COUNT(*) FROM login_attempts 
            WHERE username = ? AND success = 0 AND timestamp > datetime('now', '-15 minutes')
        ");
        $stmt->execute([$username]);
        
        return $stmt->fetchColumn() >= $auth_config['max_login_attempts'];
        
    } catch (PDOException $e) {
        error_log("Error verificando bloqueo de usuario: " . $e->getMessage());
        return false;
    }
}

/**
 * Actualizar último login
 */
function updateLastLogin($user_id) {
    $pdo = getAuthDB();
    if (!$pdo) {
        return;
    }
    
    try {
        $stmt = $pdo->prepare("UPDATE users SET last_login = CURRENT_TIMESTAMP WHERE id = ?");
        $stmt->execute([$user_id]);
        
    } catch (PDOException $e) {
        error_log("Error actualizando último login: " . $e->getMessage());
    }
}

/**
 * Crear nuevo usuario
 */
function createUser($username, $password, $email = '', $role = 'admin') {
    global $auth_config;
    
    // Validar contraseña
    if (strlen($password) < $auth_config['password_min_length']) {
        return ['success' => false, 'message' => 'La contraseña debe tener al menos ' . $auth_config['password_min_length'] . ' caracteres'];
    }
    
    if ($auth_config['require_special_chars'] && !preg_match('/[!@#$%^&*(),.?":{}|<>]/', $password)) {
        return ['success' => false, 'message' => 'La contraseña debe contener al menos un carácter especial'];
    }
    
    $pdo = getAuthDB();
    if (!$pdo) {
        return ['success' => false, 'message' => 'Error de base de datos'];
    }
    
    try {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        
        $stmt = $pdo->prepare("
            INSERT INTO users (username, password_hash, email, role) 
            VALUES (?, ?, ?, ?)
        ");
        $stmt->execute([$username, $password_hash, $email, $role]);
        
        return ['success' => true, 'message' => 'Usuario creado correctamente'];
        
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) { // SQLite constraint violation
            return ['success' => false, 'message' => 'El nombre de usuario ya existe'];
        }
        
        error_log("Error creando usuario: " . $e->getMessage());
        return ['success' => false, 'message' => 'Error interno del servidor'];
    }
}

/**
 * Cambiar contraseña
 */
function changePassword($user_id, $current_password, $new_password) {
    global $auth_config;
    
    // Validar nueva contraseña
    if (strlen($new_password) < $auth_config['password_min_length']) {
        return ['success' => false, 'message' => 'La contraseña debe tener al menos ' . $auth_config['password_min_length'] . ' caracteres'];
    }
    
    if ($auth_config['require_special_chars'] && !preg_match('/[!@#$%^&*(),.?":{}|<>]/', $new_password)) {
        return ['success' => false, 'message' => 'La contraseña debe contener al menos un carácter especial'];
    }
    
    $pdo = getAuthDB();
    if (!$pdo) {
        return ['success' => false, 'message' => 'Error de base de datos'];
    }
    
    try {
        // Verificar contraseña actual
        $stmt = $pdo->prepare("SELECT password_hash FROM users WHERE id = ?");
        $stmt->execute([$user_id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$user || !password_verify($current_password, $user['password_hash'])) {
            return ['success' => false, 'message' => 'Contraseña actual incorrecta'];
        }
        
        // Actualizar contraseña
        $new_password_hash = password_hash($new_password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("UPDATE users SET password_hash = ? WHERE id = ?");
        $stmt->execute([$new_password_hash, $user_id]);
        
        return ['success' => true, 'message' => 'Contraseña cambiada correctamente'];
        
    } catch (PDOException $e) {
        error_log("Error cambiando contraseña: " . $e->getMessage());
        return ['success' => false, 'message' => 'Error interno del servidor'];
    }
}

/**
 * Obtener información del usuario actual
 */
function getCurrentUser() {
    if (!isAuthenticated()) {
        return null;
    }
    
    $pdo = getAuthDB();
    if (!$pdo) {
        return null;
    }
    
    try {
        $stmt = $pdo->prepare("
            SELECT id, username, email, role, created_at, last_login 
            FROM users 
            WHERE id = ?
        ");
        $stmt->execute([$_SESSION['user_id']]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
        
    } catch (PDOException $e) {
        error_log("Error obteniendo información de usuario: " . $e->getMessage());
        return null;
    }
}

/**
 * Obtener todos los usuarios
 */
function getAllUsers() {
    $pdo = getAuthDB();
    if (!$pdo) {
        return [];
    }
    
    try {
        $stmt = $pdo->prepare("
            SELECT id, username, email, role, created_at, last_login, is_active 
            FROM users 
            ORDER BY created_at DESC
        ");
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        
    } catch (PDOException $e) {
        error_log("Error obteniendo usuarios: " . $e->getMessage());
        return [];
    }
}

/**
 * Obtener estadísticas de intentos de login
 */
function getLoginStats($hours = 24) {
    $pdo = getAuthDB();
    if (!$pdo) {
        return [];
    }
    
    try {
        $stmt = $pdo->prepare("
            SELECT 
                COUNT(*) as total_attempts,
                SUM(CASE WHEN success = 1 THEN 1 ELSE 0 END) as successful_logins,
                SUM(CASE WHEN success = 0 THEN 1 ELSE 0 END) as failed_attempts,
                COUNT(DISTINCT ip_address) as unique_ips
            FROM login_attempts 
            WHERE timestamp > datetime('now', '-{$hours} hours')
        ");
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
        
    } catch (PDOException $e) {
        error_log("Error obteniendo estadísticas de login: " . $e->getMessage());
        return [];
    }
}

// Inicializar base de datos al cargar el archivo
initAuthDatabase();
?>
