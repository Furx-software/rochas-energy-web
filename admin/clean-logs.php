<?php
/**
 * Script para limpiar logs antiguos
 * Solo para administradores
 */

// Inicialización
session_start();
require_once '../config/app.php';
require_once '../config/logging.php';
require_once '../config/auth.php';

// Configurar headers para AJAX
header('Content-Type: application/json');

// Verificar autenticación
if (!isAuthenticated()) {
    http_response_code(403);
    echo json_encode(['success' => false, 'message' => 'Acceso denegado']);
    exit;
}

// Solo permitir POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
    exit;
}

try {
    // Limpiar logs antiguos (más de 30 días)
    cleanOldLogs(30);
    
    // Log de la acción
    logAccess('Logs antiguos limpiados', [
        'action' => 'clean_old_logs',
        'days' => 30
    ]);
    
    echo json_encode([
        'success' => true,
        'message' => 'Logs antiguos limpiados correctamente'
    ]);
    
} catch (Exception $e) {
    // Log del error
    logError('Error limpiando logs antiguos', [
        'error' => $e->getMessage()
    ]);
    
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Error al limpiar logs: ' . $e->getMessage()
    ]);
}
?>
