<?php
/**
 * Panel de visualización de logs
 * Solo para administradores - Proteger con autenticación en producción
 */

// Inicialización
session_start();
require_once '../config/app.php';
require_once '../config/languages.php';
require_once '../config/logging.php';
require_once '../config/auth.php';

// Verificar autenticación
if (!isAuthenticated()) {
    header('Location: login.php');
    exit;
}

// Obtener parámetros
$category = $_GET['category'] ?? 'errors';
$hours = (int)($_GET['hours'] ?? 24);
$limit = (int)($_GET['limit'] ?? 50);

// Obtener estadísticas
$stats = getLogStats($category, $hours);
$recent_logs = getRecentLogs($category, $limit);

// Obtener categorías disponibles
$categories = [
    'errors' => 'Errores',
    'security' => 'Seguridad',
    'access' => 'Acceso',
    'email' => 'Email',
    'performance' => 'Rendimiento'
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Logs - Rochas Energy</title>
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
                    <h1 class="text-3xl font-bold text-gray-800 mb-2">Panel de Logs</h1>
                    <p class="text-gray-600">Monitoreo de seguridad y rendimiento - Rochas Energy</p>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="text-right">
                        <p class="text-sm text-gray-600">Bienvenido, <span class="font-semibold"><?php echo htmlspecialchars($_SESSION['username']); ?></span></p>
                        <p class="text-xs text-gray-500">Rol: <?php echo htmlspecialchars($_SESSION['role']); ?></p>
                    </div>
                    <a href="manage-users.php" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition-colors text-sm">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                        </svg>
                        Usuarios
                    </a>
                    <a href="logout.php" class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 transition-colors text-sm">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        Cerrar Sesión
                    </a>
                </div>
            </div>
        </div>

        <!-- Filtros -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <form method="GET" class="flex flex-wrap gap-4 items-end">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Categoría</label>
                    <select name="category" class="border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary-500">
                        <?php foreach ($categories as $key => $name): ?>
                            <option value="<?php echo $key; ?>" <?php echo $category === $key ? 'selected' : ''; ?>>
                                <?php echo $name; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Horas</label>
                    <select name="hours" class="border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary-500">
                        <option value="1" <?php echo $hours === 1 ? 'selected' : ''; ?>>1 hora</option>
                        <option value="6" <?php echo $hours === 6 ? 'selected' : ''; ?>>6 horas</option>
                        <option value="24" <?php echo $hours === 24 ? 'selected' : ''; ?>>24 horas</option>
                        <option value="168" <?php echo $hours === 168 ? 'selected' : ''; ?>>7 días</option>
                    </select>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Límite</label>
                    <select name="limit" class="border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary-500">
                        <option value="25" <?php echo $limit === 25 ? 'selected' : ''; ?>>25</option>
                        <option value="50" <?php echo $limit === 50 ? 'selected' : ''; ?>>50</option>
                        <option value="100" <?php echo $limit === 100 ? 'selected' : ''; ?>>100</option>
                    </select>
                </div>
                
                <button type="submit" class="bg-primary-600 text-white px-4 py-2 rounded-md hover:bg-primary-700 transition-colors">
                    Filtrar
                </button>
            </form>
        </div>

        <!-- Estadísticas -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4 mb-6">
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="p-2 bg-blue-100 rounded-lg">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total</p>
                        <p class="text-2xl font-bold text-gray-900"><?php echo $stats['total']; ?></p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="p-2 bg-red-100 rounded-lg">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Errores</p>
                        <p class="text-2xl font-bold text-red-600"><?php echo $stats['errors']; ?></p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="p-2 bg-yellow-100 rounded-lg">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Advertencias</p>
                        <p class="text-2xl font-bold text-yellow-600"><?php echo $stats['warnings']; ?></p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="p-2 bg-green-100 rounded-lg">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Info</p>
                        <p class="text-2xl font-bold text-green-600"><?php echo $stats['info']; ?></p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="p-2 bg-purple-100 rounded-lg">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Seguridad</p>
                        <p class="text-2xl font-bold text-purple-600"><?php echo $stats['security_events']; ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Logs -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Logs Recientes - <?php echo $categories[$category]; ?></h2>
            
            <?php if (empty($recent_logs)): ?>
                <div class="text-center py-8">
                    <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <p class="text-gray-500">No hay logs disponibles para esta categoría</p>
                </div>
            <?php else: ?>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Timestamp</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nivel</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mensaje</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">IP</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">URI</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php foreach ($recent_logs as $log): ?>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <?php echo $log['timestamp']; ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                                            <?php 
                                            switch ($log['level']) {
                                                case 'ERROR': echo 'bg-red-100 text-red-800'; break;
                                                case 'WARNING': echo 'bg-yellow-100 text-yellow-800'; break;
                                                case 'INFO': echo 'bg-green-100 text-green-800'; break;
                                                default: echo 'bg-gray-100 text-gray-800';
                                            }
                                            ?>">
                                            <?php echo $log['level']; ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900">
                                        <div class="max-w-xs truncate" title="<?php echo htmlspecialchars($log['message']); ?>">
                                            <?php echo htmlspecialchars($log['message']); ?>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <?php echo htmlspecialchars($log['ip']); ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <div class="max-w-xs truncate" title="<?php echo htmlspecialchars($log['request_uri']); ?>">
                                            <?php echo htmlspecialchars($log['request_uri']); ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>

        <!-- Acciones -->
        <div class="bg-white rounded-lg shadow-md p-6 mt-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Acciones</h3>
            <div class="flex flex-wrap gap-4">
                <button onclick="location.reload()" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition-colors">
                    Actualizar
                </button>
                <button onclick="exportLogs()" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition-colors">
                    Exportar Logs
                </button>
                <button onclick="cleanOldLogs()" class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 transition-colors">
                    Limpiar Logs Antiguos
                </button>
            </div>
        </div>
    </div>

    <script>
        function exportLogs() {
            const url = new URL(window.location);
            url.searchParams.set('export', '1');
            window.open(url.toString(), '_blank');
        }
        
        function cleanOldLogs() {
            if (confirm('¿Estás seguro de que quieres limpiar los logs antiguos? Esta acción no se puede deshacer.')) {
                fetch('clean-logs.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Logs limpiados correctamente');
                        location.reload();
                    } else {
                        alert('Error al limpiar logs: ' + data.message);
                    }
                })
                .catch(error => {
                    alert('Error: ' + error.message);
                });
            }
        }
        
        // Auto-refresh cada 30 segundos
        setInterval(() => {
            location.reload();
        }, 30000);
    </script>
</body>
</html>
