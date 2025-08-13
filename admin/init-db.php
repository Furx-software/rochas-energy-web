<?php
/**
 * Script de inicialización de la base de datos
 * Rochas Energy - Inicializar SQLite
 */

require_once '../config/auth.php';

echo "<h1>Inicializando Base de Datos</h1>";

try {
    // Inicializar la base de datos
    $pdo = initAuthDatabase();
    
    if ($pdo) {
        echo "<p style='color: green;'>✅ Base de datos inicializada correctamente</p>";
        
        // Verificar si existe el usuario admin
        $stmt = $pdo->prepare("SELECT username, email FROM users WHERE username = ?");
        $stmt->execute(['admin']);
        $user = $stmt->fetch();
        
        if ($user) {
            echo "<p style='color: blue;'>ℹ️ Usuario 'admin' ya existe</p>";
            echo "<p><strong>Credenciales por defecto:</strong></p>";
            echo "<ul>";
            echo "<li><strong>Usuario:</strong> admin</li>";
            echo "<li><strong>Contraseña:</strong> admin123</li>";
            echo "</ul>";
        } else {
            echo "<p style='color: red;'>❌ Usuario 'admin' no encontrado</p>";
        }
        
        // Mostrar estadísticas
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM users");
        $stmt->execute();
        $user_count = $stmt->fetchColumn();
        
        echo "<p><strong>Total de usuarios:</strong> $user_count</p>";
        
        // Mostrar directorio de la base de datos
        $db_path = $pdo->query("PRAGMA database_list")->fetch(PDO::FETCH_ASSOC);
        echo "<p><strong>Ubicación de la BD:</strong> " . $db_path['file'] . "</p>";
        
    } else {
        echo "<p style='color: red;'>❌ Error al inicializar la base de datos</p>";
    }
    
} catch (Exception $e) {
    echo "<p style='color: red;'>❌ Error: " . $e->getMessage() . "</p>";
}

echo "<hr>";
echo "<p><a href='login.php'>Ir al login</a></p>";
echo "<p><a href='../'>Volver al sitio principal</a></p>";
?>
