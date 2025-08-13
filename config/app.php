<?php
// Configuración central de la aplicación
// Este archivo se carga una sola vez y contiene toda la configuración necesaria

// Configuración de la aplicación
define('APP_NAME', 'Rochas Energy');
define('APP_VERSION', '1.0.0');
define('APP_ENV', 'development'); // development, production

// Configuración de rutas
define('BASE_URL', 'http://localhost:8000');
define('ASSETS_PATH', '/assets');
define('IMAGES_PATH', '/src/img');

// Configuración de caché
define('CACHE_ENABLED', true);
define('CACHE_DURATION', 3600); // 1 hora

// Configuración de seguridad
define('SESSION_TIMEOUT', 1800); // 30 minutos

// Configuración de idiomas
define('DEFAULT_LANGUAGE', 'es');
define('AVAILABLE_LANGUAGES', ['es', 'en']);

// Configuración de páginas
define('VALID_PAGES', [
    'home',
    'servicios', 
    'contacto',
    '404'
]);

// Función para obtener configuración
function getConfig($key, $default = null) {
    static $config = null;
    
    if ($config === null) {
        $config = [
            'app_name' => APP_NAME,
            'app_version' => APP_VERSION,
            'app_env' => APP_ENV,
            'base_url' => BASE_URL,
            'assets_path' => ASSETS_PATH,
            'images_path' => IMAGES_PATH,
            'cache_enabled' => CACHE_ENABLED,
            'cache_duration' => CACHE_DURATION,
            'session_timeout' => SESSION_TIMEOUT,
            'default_language' => DEFAULT_LANGUAGE,
            'available_languages' => AVAILABLE_LANGUAGES,
            'valid_pages' => VALID_PAGES
        ];
    }
    
    return $config[$key] ?? $default;
}

// Función para verificar si estamos en desarrollo
function isDevelopment() {
    return getConfig('app_env') === 'development';
}

// Función para verificar si estamos en producción
function isProduction() {
    return getConfig('app_env') === 'production';
}

// Función para obtener la URL base
function getBaseUrl() {
    return getConfig('base_url');
}

// Función para obtener la ruta de assets
function getAssetsPath() {
    return getConfig('assets_path');
}

// Función para obtener la ruta de imágenes
function getImagesPath() {
    return getConfig('images_path');
}
?>
