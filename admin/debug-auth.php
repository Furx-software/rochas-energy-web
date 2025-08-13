<?php
/**
 * Script de debug para verificar sistema de autenticación
 * Rochas Energy - Debug de autenticación
 */

// Inicialización
session_start();
require_once '../config/app.php';
require_once '../config/auth.php';

echo "<h1>🔍 Debug del Sistema de Autenticación</h1>";

// Verificar base de datos
echo "<h2>📊 Estado de la Base de Datos</h2>";
$pdo = getAuthDB();
if ($pdo) {
    echo "✅ Conexión a SQLite exitosa<br>";
    
    // Verificar tablas
    $tables = $pdo->query("SELECT name FROM sqlite_master WHERE type='table'")->fetchAll(PDO::FETCH_COLUMN);
    echo "📋 Tablas encontradas: " . implode(', ', $tables) . "<br>";
    
    // Verificar usuarios
    $users = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
    echo "👥 Usuarios registrados: $users<br>";
    
    // Mostrar usuarios
    $stmt = $pdo->query("SELECT id, username, email, role, is_active FROM users");
    echo "<h3>👤 Usuarios en la base de datos:</h3>";
    echo "<table border='1' style='border-collapse: collapse;'>";
    echo "<tr><th>ID</th><th>Usuario</th><th>Email</th><th>Rol</th><th>Activo</th></tr>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . htmlspecialchars($row['username']) . "</td>";
        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
        echo "<td>" . htmlspecialchars($row['role']) . "</td>";
        echo "<td>" . ($row['is_active'] ? 'Sí' : 'No') . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    
} else {
    echo "❌ Error conectando a la base de datos<br>";
}

// Verificar sesión
echo "<h2>🔐 Estado de la Sesión</h2>";
if (isset($_SESSION['user_id'])) {
    echo "✅ Usuario autenticado: " . htmlspecialchars($_SESSION['username']) . "<br>";
    echo "🆔 ID de usuario: " . $_SESSION['user_id'] . "<br>";
    echo "👑 Rol: " . htmlspecialchars($_SESSION['role']) . "<br>";
    echo "⏰ Login time: " . date('d/m/Y H:i:s', $_SESSION['login_time']) . "<br>";
} else {
    echo "❌ No hay sesión activa<br>";
}

// Verificar función de autenticación
echo "<h2>🔑 Prueba de Autenticación</h2>";
if (isset($_POST['test_username']) && isset($_POST['test_password'])) {
    $username = $_POST['test_username'];
    $password = $_POST['test_password'];
    
    echo "🧪 Probando autenticación para: $username<br>";
    $result = authenticateUser($username, $password);
    
    if ($result['success']) {
        echo "✅ Autenticación exitosa<br>";
        echo "👤 Usuario: " . htmlspecialchars($result['user']['username']) . "<br>";
        echo "👑 Rol: " . htmlspecialchars($result['user']['role']) . "<br>";
    } else {
        echo "❌ Autenticación fallida: " . htmlspecialchars($result['message']) . "<br>";
    }
}

// Verificar bloqueos
echo "<h2>🚫 Estado de Bloqueos</h2>";
if (isset($_POST['test_username'])) {
    $username = $_POST['test_username'];
    $is_locked = isUserLocked($username);
    echo "🔒 Usuario '$username' bloqueado: " . ($is_locked ? 'Sí' : 'No') . "<br>";
}

// Formulario de prueba
echo "<h2>🧪 Formulario de Prueba</h2>";
echo "<form method='POST'>";
echo "<label>Usuario: <input type='text' name='test_username' value='" . htmlspecialchars($_POST['test_username'] ?? '') . "'></label><br>";
echo "<label>Contraseña: <input type='password' name='test_password'></label><br>";
echo "<button type='submit'>Probar Autenticación</button>";
echo "</form>";

// Verificar intentos de login
echo "<h2>📈 Intentos de Login (últimas 24h)</h2>";
$login_stats = getLoginStats(24);
echo "📊 Total intentos: " . ($login_stats['total_attempts'] ?? 0) . "<br>";
echo "✅ Exitosos: " . ($login_stats['successful_logins'] ?? 0) . "<br>";
echo "❌ Fallidos: " . ($login_stats['failed_attempts'] ?? 0) . "<br>";
echo "🌐 IPs únicas: " . ($login_stats['unique_ips'] ?? 0) . "<br>";

// Información del sistema
echo "<h2>⚙️ Información del Sistema</h2>";
echo "🔧 PHP Version: " . PHP_VERSION . "<br>";
echo "📁 Directorio actual: " . getcwd() . "<br>";
echo "🗄️ Base de datos: " . realpath('users.db') . "<br>";
echo "🔐 Session ID: " . session_id() . "<br>";

echo "<hr>";
echo "<p><a href='login.php'>← Volver al Login</a> | <a href='manage-users.php'>← Gestión de Usuarios</a></p>";
?>
