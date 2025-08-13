<?php
/**
 * Página de login para panel de administración
 * Rochas Energy - Autenticación
 */

// Inicialización
session_start();
require_once '../config/app.php';
require_once '../config/languages.php';
require_once '../config/auth.php';

// Si ya está autenticado, redirigir al panel
if (isAuthenticated()) {
    header('Location: logs-viewer.php');
    exit;
}

$error_message = '';
$success_message = '';

// Procesar formulario de login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    
    if (empty($username) || empty($password)) {
        $error_message = 'Por favor, completa todos los campos';
    } else {
        $result = authenticateUser($username, $password);
        
        if ($result['success']) {
            // Login exitoso
            header('Location: logs-viewer.php');
            exit;
        } else {
            $error_message = $result['message'];
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Panel de Administración - Rochas Energy</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#eff6ff',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8'
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="max-w-md w-full space-y-8">
        <!-- Logo y título -->
        <div class="text-center">
            <div class="flex justify-center mb-4">
                <img src="../src/img/logo_rochas_rosa.png" alt="Rochas Logo" class="h-16 w-auto">
            </div>
            <h2 class="text-3xl font-bold text-gray-900">Panel de Administración</h2>
            <p class="mt-2 text-sm text-gray-600">Rochas Energy - Acceso seguro</p>
        </div>

        <!-- Formulario de login -->
        <div class="bg-white rounded-lg shadow-md p-8">
            <?php if ($error_message): ?>
                <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-md">
                    <div class="flex">
                        <svg class="w-5 h-5 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        <?php echo htmlspecialchars($error_message); ?>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ($success_message): ?>
                <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-md">
                    <div class="flex">
                        <svg class="w-5 h-5 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        <?php echo htmlspecialchars($success_message); ?>
                    </div>
                </div>
            <?php endif; ?>

            <form method="POST" class="space-y-6">
                <div>
                    <label for="username" class="block text-sm font-medium text-gray-700 mb-2">
                        Usuario
                    </label>
                    <input 
                        type="text" 
                        id="username" 
                        name="username" 
                        required 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                        placeholder="Ingresa tu usuario"
                        value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>"
                    >
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                        Contraseña
                    </label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        required 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                        placeholder="Ingresa tu contraseña"
                    >
                </div>

                <div>
                    <button 
                        type="submit" 
                        class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-colors duration-200"
                    >
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                        </svg>
                        Iniciar Sesión
                    </button>
                </div>
            </form>

            <!-- Información adicional -->
            <div class="mt-6 text-center">
                <p class="text-xs text-gray-500">
                    Acceso restringido solo para administradores autorizados
                </p>
                <p class="text-xs text-gray-400 mt-1">
                    Rochas Energy - Sistema de seguridad
                </p>
            </div>
        </div>

        <!-- Enlace de vuelta -->
        <div class="text-center">
            <a href="../" class="text-primary-600 hover:text-primary-500 text-sm">
                ← Volver al sitio principal
            </a>
        </div>
    </div>

    <script>
        // Auto-focus en el campo de usuario
        document.getElementById('username').focus();
        
        // Prevenir múltiples envíos del formulario
        document.querySelector('form').addEventListener('submit', function(e) {
            const button = this.querySelector('button[type="submit"]');
            button.disabled = true;
            button.innerHTML = '<svg class="animate-spin w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Iniciando sesión...';
        });
    </script>
</body>
</html>
