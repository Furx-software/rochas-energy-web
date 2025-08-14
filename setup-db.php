<?php
/**
 * Script de setup directo para la base de datos
 * Rochas Energy - Setup de BD
 */

echo "🔧 Inicializando base de datos Rochas Energy...\n\n";

// Verificar si ya existe la base de datos
$db_path = '/var/www/html/admin/users.db';

// Detectar si estamos en Render
$is_render = getenv("RENDER") !== false;
if ($is_render) {
    echo "🌐 Detectado entorno Render\n";
}

if (file_exists($db_path)) {
    echo "✅ La base de datos ya existe en: $db_path\n";
    echo "📊 Tamaño: " . filesize($db_path) . " bytes\n";
    echo "📅 Última modificación: " . date('Y-m-d H:i:s', filemtime($db_path)) . "\n\n";
    
    // En Render, no preguntar, solo recrear
    if ($is_render) {
        echo "🔄 Recreando base de datos en Render...\n";
        unlink($db_path);
        echo "🗑️ Base de datos anterior eliminada.\n\n";
    } else {
        echo "¿Quieres recrear la base de datos? (y/N): ";
        $handle = fopen("php://stdin", "r");
        $line = fgets($handle);
        fclose($handle);
        
        if (trim(strtolower($line)) !== 'y') {
            echo "❌ Operación cancelada.\n";
            exit(0);
        }
        
        // Eliminar base de datos existente
        unlink($db_path);
        echo "🗑️ Base de datos anterior eliminada.\n\n";
    }
}

// Crear directorio admin si no existe
$admin_dir = '/var/www/html/admin';
if (!is_dir($admin_dir)) {
    if (!mkdir($admin_dir, 0777, true)) {
        echo "❌ Error: No se pudo crear el directorio: $admin_dir\n";
        exit(1);
    }
    echo "📁 Directorio admin creado: $admin_dir\n";
}

// Inicializar base de datos
try {
    $pdo = new PDO("sqlite:$db_path");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "🔗 Conexión a SQLite establecida.\n";
    
    // Crear tabla de usuarios
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
    echo "👥 Tabla de usuarios creada.\n";
    
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
    echo "🔐 Tabla de intentos de login creada.\n";
    
    // Crear usuario por defecto
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = ?");
    $stmt->execute(['admin']);
    
    if ($stmt->fetchColumn() == 0) {
        $default_password = 'admin123';
        $password_hash = password_hash($default_password, PASSWORD_DEFAULT);
        
        $stmt = $pdo->prepare("
            INSERT INTO users (username, password_hash, email, role) 
            VALUES (?, ?, ?, ?)
        ");
        $stmt->execute(['admin', $password_hash, 'admin@rochasenergy.com', 'admin']);
        
        echo "👤 Usuario administrador creado.\n";
    } else {
        echo "👤 Usuario administrador ya existe.\n";
    }
    
    // Verificar que todo funciona
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM users");
    $stmt->execute();
    $user_count = $stmt->fetchColumn();
    
    echo "\n✅ Base de datos inicializada correctamente!\n";
    echo "📊 Usuarios en la base de datos: $user_count\n";
    echo "📁 Ubicación: $db_path\n";
    echo "🔑 Credenciales por defecto:\n";
    echo "   Usuario: admin\n";
    echo "   Contraseña: admin123\n\n";
    
    echo "🌐 Para acceder al panel de administración:\n";
    echo "   Local: http://localhost:8080/admin/login.php\n";
    echo "   Render: https://tu-app.onrender.com/admin/login.php\n";
    
} catch (PDOException $e) {
    echo "❌ Error al inicializar la base de datos: " . $e->getMessage() . "\n";
    exit(1);
} catch (Exception $e) {
    echo "❌ Error inesperado: " . $e->getMessage() . "\n";
    exit(1);
}

echo "\n🎉 ¡Setup completado exitosamente!\n";
?>
