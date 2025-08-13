<?php
/**
 * Gestión de usuarios del panel de administración
 * Rochas Energy - Administración de usuarios
 */

// Inicialización
session_start();
require_once '../config/app.php';
require_once '../config/languages.php';
require_once '../config/auth.php';

// Verificar autenticación y rol de administrador
if (!isAuthenticated() || !hasRole('admin')) {
    header('Location: login.php');
    exit;
}

$message = '';
$message_type = '';

// Procesar acciones
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    
    switch ($action) {
        case 'create_user':
            $username = trim($_POST['username'] ?? '');
            $password = $_POST['password'] ?? '';
            $email = trim($_POST['email'] ?? '');
            $role = $_POST['role'] ?? 'admin';
            
            $result = createUser($username, $password, $email, $role);
            $message = $result['message'];
            $message_type = $result['success'] ? 'success' : 'error';
            break;
            
        case 'change_password':
            $current_password = $_POST['current_password'] ?? '';
            $new_password = $_POST['new_password'] ?? '';
            
            $result = changePassword($_SESSION['user_id'], $current_password, $new_password);
            $message = $result['message'];
            $message_type = $result['success'] ? 'success' : 'error';
            break;
    }
}

// Obtener información del usuario actual
$current_user = getCurrentUser();
$login_stats = getLoginStats(24);
$all_users = getAllUsers();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Usuarios - Panel de Administración - Rochas Energy</title>
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
<body class="bg-gray-100 min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800 mb-2">Gestión de Usuarios</h1>
                    <p class="text-gray-600">Administración de usuarios del panel - Rochas Energy</p>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="text-right">
                        <p class="text-sm text-gray-600">Bienvenido, <span class="font-semibold"><?php echo htmlspecialchars($_SESSION['username']); ?></span></p>
                        <p class="text-xs text-gray-500">Rol: <?php echo htmlspecialchars($_SESSION['role']); ?></p>
                    </div>
                    <a href="logs-viewer.php" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition-colors text-sm">
                        Panel de Logs
                    </a>
                    <a href="logout.php" class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 transition-colors text-sm">
                        Cerrar Sesión
                    </a>
                </div>
            </div>
        </div>

        <!-- Mensajes -->
        <?php if ($message): ?>
            <div class="mb-6 <?php echo $message_type === 'success' ? 'bg-green-50 border-green-200 text-green-700' : 'bg-red-50 border-red-200 text-red-700'; ?> border px-4 py-3 rounded-md">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Información del Usuario Actual -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Mi Cuenta</h2>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Usuario</label>
                        <p class="text-gray-900 font-semibold"><?php echo htmlspecialchars($current_user['username']); ?></p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Email</label>
                        <p class="text-gray-900"><?php echo htmlspecialchars($current_user['email']); ?></p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Rol</label>
                        <p class="text-gray-900"><?php echo htmlspecialchars($current_user['role']); ?></p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Último Login</label>
                        <p class="text-gray-900"><?php echo $current_user['last_login'] ? date('d/m/Y H:i:s', strtotime($current_user['last_login'])) : 'Nunca'; ?></p>
                    </div>
                </div>
            </div>

            <!-- Estadísticas de Login -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Estadísticas de Login (24h)</h2>
                
                <div class="grid grid-cols-2 gap-4">
                    <div class="text-center">
                        <p class="text-2xl font-bold text-blue-600"><?php echo $login_stats['total_attempts'] ?? 0; ?></p>
                        <p class="text-sm text-gray-600">Total Intentos</p>
                    </div>
                    
                    <div class="text-center">
                        <p class="text-2xl font-bold text-green-600"><?php echo $login_stats['successful_logins'] ?? 0; ?></p>
                        <p class="text-sm text-gray-600">Logins Exitosos</p>
                    </div>
                    
                    <div class="text-center">
                        <p class="text-2xl font-bold text-red-600"><?php echo $login_stats['failed_attempts'] ?? 0; ?></p>
                        <p class="text-sm text-gray-600">Intentos Fallidos</p>
                    </div>
                    
                    <div class="text-center">
                        <p class="text-2xl font-bold text-purple-600"><?php echo $login_stats['unique_ips'] ?? 0; ?></p>
                        <p class="text-sm text-gray-600">IPs Únicas</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cambiar Contraseña -->
        <div class="bg-white rounded-lg shadow-md p-6 mt-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Cambiar Mi Contraseña</h2>
            
            <form method="POST" class="max-w-md">
                <input type="hidden" name="action" value="change_password">
                
                <div class="space-y-4">
                    <div>
                        <label for="current_password" class="block text-sm font-medium text-gray-700">Contraseña Actual</label>
                        <input type="password" id="current_password" name="current_password" required 
                               class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500">
                    </div>
                    
                    <div>
                        <label for="new_password" class="block text-sm font-medium text-gray-700">Nueva Contraseña</label>
                        <input type="password" id="new_password" name="new_password" required 
                               class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500">
                        <p class="text-xs text-gray-500 mt-1">Mínimo 8 caracteres, incluir carácter especial</p>
                    </div>
                    
                    <button type="submit" class="bg-primary-600 text-white px-4 py-2 rounded-md hover:bg-primary-700 transition-colors">
                        Cambiar Contraseña
                    </button>
                </div>
            </form>
        </div>

        <!-- Lista de Usuarios -->
        <div class="bg-white rounded-lg shadow-md p-6 mt-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Usuarios del Sistema</h2>
            
            <?php if (empty($all_users)): ?>
                <div class="text-center py-8">
                    <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                    </svg>
                    <p class="text-gray-500">No hay usuarios registrados</p>
                </div>
            <?php else: ?>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Usuario</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rol</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Creado</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Último Login</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php foreach ($all_users as $user): ?>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <div class="h-10 w-10 rounded-full bg-primary-100 flex items-center justify-center">
                                                    <span class="text-primary-800 font-semibold text-sm">
                                                        <?php echo strtoupper(substr($user['username'], 0, 2)); ?>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    <?php echo htmlspecialchars($user['username']); ?>
                                                    <?php if ($user['id'] == $_SESSION['user_id']): ?>
                                                        <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                            Tú
                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="text-sm text-gray-500">ID: <?php echo $user['id']; ?></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <?php echo htmlspecialchars($user['email']); ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                                            <?php echo $user['role'] === 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-green-100 text-green-800'; ?>">
                                            <?php echo ucfirst($user['role']); ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                                            <?php echo $user['is_active'] ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>">
                                            <?php echo $user['is_active'] ? 'Activo' : 'Inactivo'; ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <?php echo date('d/m/Y H:i', strtotime($user['created_at'])); ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <?php echo $user['last_login'] ? date('d/m/Y H:i', strtotime($user['last_login'])) : 'Nunca'; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>

        <!-- Crear Nuevo Usuario -->
        <div class="bg-white rounded-lg shadow-md p-6 mt-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Crear Nuevo Usuario</h2>
            
            <form method="POST" class="max-w-md">
                <input type="hidden" name="action" value="create_user">
                
                <div class="space-y-4">
                    <div>
                        <label for="username" class="block text-sm font-medium text-gray-700">Usuario</label>
                        <input type="text" id="username" name="username" required 
                               class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500">
                    </div>
                    
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" id="email" name="email" 
                               class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500">
                    </div>
                    
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
                        <input type="password" id="password" name="password" required 
                               class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500">
                        <p class="text-xs text-gray-500 mt-1">Mínimo 8 caracteres, incluir carácter especial</p>
                    </div>
                    
                    <div>
                        <label for="role" class="block text-sm font-medium text-gray-700">Rol</label>
                        <select id="role" name="role" 
                                class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500">
                            <option value="admin">Administrador</option>
                            <option value="viewer">Visualizador</option>
                        </select>
                    </div>
                    
                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition-colors">
                        Crear Usuario
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
