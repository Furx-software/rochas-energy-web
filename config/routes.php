<?php
// Configuración de rutas válidas (centralizada)
$valid_routes = [
    '' => 'home',
    'home' => 'home',
    'index' => 'home',
    'servicios' => 'servicios',
    'services' => 'servicios',
    'contacto' => 'contacto',
    'contact' => 'contacto',
    'politica-privacidad' => 'politica-privacidad',
    'privacy-policy' => 'politica-privacidad',
    'terminos-condiciones' => 'terminos-condiciones',
    'terms-conditions' => 'terminos-condiciones'
];

// Sistema de rutas para URLs amigables
function getCurrentRoute() {
    // Para servidor de desarrollo PHP que no procesa .htaccess
    $request_uri = $_SERVER['REQUEST_URI'] ?? '';
    $script_name = $_SERVER['SCRIPT_NAME'] ?? '';
    
    // Si estamos usando el servidor de desarrollo PHP
    if (strpos($request_uri, $script_name) === false) {
        // Extraer la ruta de REQUEST_URI
        $route = parse_url($request_uri, PHP_URL_PATH);
        $route = trim($route, '/');
        return $route;
    }
    
    // Para servidor Apache con .htaccess
    $route = $_GET['route'] ?? '';
    $route = trim($route, '/');
    return $route;
}

function isCurrentRoute($route) {
    return getCurrentRoute() === $route;
}

function redirectTo($route) {
    header("Location: /$route");
    exit();
}

function getPageContent() {
    global $valid_routes;
    $route = getCurrentRoute();
    
    // Verificar si la ruta existe
    if (array_key_exists($route, $valid_routes)) {
        return $valid_routes[$route];
    }
    
    // Si no existe, devolver 404
    return '404';
}

// Función para generar URLs amigables
function url($route = '') {
    $base = rtrim($_SERVER['REQUEST_URI'], '/');
    $base = preg_replace('/\?.*/', '', $base);
    $base = preg_replace('/\/[^\/]*$/', '', $base);
    
    if (empty($route)) {
        return $base;
    }
    
    return $base . '/' . ltrim($route, '/');
}

// Función para verificar si una página existe
function pageExists($route) {
    global $valid_routes;
    return array_key_exists($route, $valid_routes);
}
?>
