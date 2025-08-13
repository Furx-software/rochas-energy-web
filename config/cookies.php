<?php
/**
 * Configuración del sistema de cookies
 */

// Configuración de cookies
$cookie_config = [
    // Cookie principal de aceptación
    'acceptance_cookie' => 'rochas_cookies_accepted',
    
    // Duración de las cookies (en días)
    'acceptance_duration' => 365, // 1 año
    
    // Configuración de seguridad
    'secure' => true, // Habilitado para HTTPS
    'httponly' => false, // Las cookies de JavaScript no pueden ser httponly
    'samesite' => 'Lax', // 'Strict', 'Lax', o 'None'
    
    // Configuración de dominio
    'domain' => '', // Dejar vacío para el dominio actual
    'path' => '/',
    
    // Tipos de cookies
    'cookie_types' => [
        'essential' => [
            'name' => 'Essential Cookies',
            'description' => 'Cookies necesarias para el funcionamiento básico del sitio web',
            'required' => true
        ],
        'analytics' => [
            'name' => 'Analytics Cookies',
            'description' => 'Cookies para analizar el tráfico y uso del sitio web',
            'required' => false
        ],
        'marketing' => [
            'name' => 'Marketing Cookies',
            'description' => 'Cookies para mostrar publicidad personalizada',
            'required' => false
        ],
        'preferences' => [
            'name' => 'Preference Cookies',
            'description' => 'Cookies para recordar tus preferencias',
            'required' => false
        ]
    ]
];

/**
 * Establecer cookie de aceptación
 */
function setCookieAcceptance($accepted = true) {
    global $cookie_config;
    
    $expiry = time() + ($cookie_config['acceptance_duration'] * 24 * 60 * 60);
    
    return setcookie(
        $cookie_config['acceptance_cookie'],
        $accepted ? 'true' : 'false',
        [
            'expires' => $expiry,
            'path' => $cookie_config['path'],
            'domain' => $cookie_config['domain'],
            'secure' => $cookie_config['secure'],
            'httponly' => $cookie_config['httponly'],
            'samesite' => $cookie_config['samesite']
        ]
    );
}

/**
 * Verificar si las cookies han sido aceptadas
 */
function areCookiesAccepted() {
    global $cookie_config;
    
    return isset($_COOKIE[$cookie_config['acceptance_cookie']]) && 
           $_COOKIE[$cookie_config['acceptance_cookie']] === 'true';
}

/**
 * Verificar si las cookies han sido rechazadas
 */
function areCookiesRejected() {
    global $cookie_config;
    
    return isset($_COOKIE[$cookie_config['acceptance_cookie']]) && 
           $_COOKIE[$cookie_config['acceptance_cookie']] === 'false';
}

/**
 * Verificar si se ha tomado alguna decisión sobre las cookies
 */
function hasCookieDecision() {
    global $cookie_config;
    
    return isset($_COOKIE[$cookie_config['acceptance_cookie']]);
}

/**
 * Obtener configuración de cookies
 */
function getCookieConfig() {
    global $cookie_config;
    return $cookie_config;
}

/**
 * Limpiar todas las cookies del sitio (excepto la de aceptación)
 */
function clearSiteCookies() {
    global $cookie_config;
    
    if (isset($_SERVER['HTTP_COOKIE'])) {
        $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
        foreach($cookies as $cookie) {
            $parts = explode('=', $cookie);
            $name = trim($parts[0]);
            
            // No eliminar la cookie de aceptación
            if ($name !== $cookie_config['acceptance_cookie']) {
                setcookie($name, '', time() - 3600, '/');
            }
        }
    }
}

/**
 * Generar HTML para la política de cookies
 */
function generateCookiePolicyHTML($language = 'es') {
    global $cookie_config;
    
    $html = '<div class="cookie-policy">';
    $html .= '<h2>' . ($language === 'es' ? 'Política de Cookies' : 'Cookie Policy') . '</h2>';
    $html .= '<p>' . ($language === 'es' ? 
        'Esta política de cookies explica cómo Rochas Energy utiliza las cookies en nuestro sitio web.' : 
        'This cookie policy explains how Rochas Energy uses cookies on our website.') . '</p>';
    
    $html .= '<h3>' . ($language === 'es' ? '¿Qué son las cookies?' : 'What are cookies?') . '</h3>';
    $html .= '<p>' . ($language === 'es' ? 
        'Las cookies son pequeños archivos de texto que se almacenan en tu dispositivo cuando visitas un sitio web.' : 
        'Cookies are small text files that are stored on your device when you visit a website.') . '</p>';
    
    $html .= '<h3>' . ($language === 'es' ? 'Tipos de cookies que utilizamos' : 'Types of cookies we use') . '</h3>';
    
    foreach ($cookie_config['cookie_types'] as $type => $config) {
        $html .= '<div class="cookie-type">';
        $html .= '<h4>' . $config['name'] . '</h4>';
        $html .= '<p>' . $config['description'] . '</p>';
        if ($config['required']) {
            $html .= '<span class="required">' . ($language === 'es' ? 'Siempre activas' : 'Always active') . '</span>';
        }
        $html .= '</div>';
    }
    
    $html .= '<h3>' . ($language === 'es' ? 'Cómo gestionar las cookies' : 'How to manage cookies') . '</h3>';
    $html .= '<p>' . ($language === 'es' ? 
        'Puedes cambiar tus preferencias de cookies en cualquier momento usando el botón de configuración de cookies.' : 
        'You can change your cookie preferences at any time using the cookie settings button.') . '</p>';
    
    $html .= '</div>';
    
    return $html;
}

/**
 * Verificar si se debe mostrar el banner de cookies
 */
function shouldShowCookieBanner() {
    return !hasCookieDecision();
}

/**
 * Obtener estadísticas de aceptación de cookies
 */
function getCookieAcceptanceStats() {
    // Esta función podría conectarse a una base de datos para obtener estadísticas
    // Por ahora, retornamos datos de ejemplo
    return [
        'total_visits' => 0,
        'accepted' => 0,
        'rejected' => 0,
        'no_decision' => 0
    ];
}
?>
