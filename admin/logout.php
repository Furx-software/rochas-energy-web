<?php
/**
 * Página de logout para panel de administración
 * Rochas Energy - Cerrar sesión
 */

// Inicialización
session_start();
require_once '../config/app.php';
require_once '../config/auth.php';

// Log de logout
if (isset($_SESSION['username'])) {
    if (function_exists('logAccess')) {
        logAccess('Logout realizado', [
            'user' => $_SESSION['username'],
            'action' => 'logout'
        ]);
    }
}

// Cerrar sesión
logout();

// Redirigir al login
header('Location: login.php');
exit;
?>
