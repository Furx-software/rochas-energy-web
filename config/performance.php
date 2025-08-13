<?php
/**
 * Configuración de optimizaciones de rendimiento y SEO
 * Rochas Energy - Optimizaciones avanzadas
 */

// Configuración de caché
$cache_config = [
    'enabled' => true,
    'duration' => 3600, // 1 hora
    'compress' => true,
    'gzip' => true
];

// Configuración de compresión
$compression_config = [
    'gzip' => true,
    'brotli' => false, // Habilitar si el servidor lo soporta
    'minify_html' => true,
    'minify_css' => true,
    'minify_js' => true
];

// Configuración de imágenes
$image_config = [
    'webp' => true,
    'lazy_loading' => true,
    'responsive' => true,
    'optimization' => true
];

// Configuración de CDN
$cdn_config = [
    'enabled' => false, // Cambiar a true cuando se configure CDN
    'domain' => 'cdn.rochasenergy.com',
    'assets' => ['css', 'js', 'images']
];

// Configuración de SEO
$seo_config = [
    'structured_data' => true,
    'open_graph' => true,
    'twitter_cards' => true,
    'canonical_urls' => true,
    'meta_robots' => true,
    'sitemap' => true
];

// Configuración de seguridad
$security_config = [
    'csp' => true,
    'hsts' => true,
    'xss_protection' => true,
    'content_type_options' => true,
    'frame_options' => true
];

/**
 * Aplicar optimizaciones de rendimiento
 */
function applyPerformanceOptimizations() {
    global $cache_config, $compression_config, $security_config;
    
    // Headers de caché
    if ($cache_config['enabled']) {
        header('Cache-Control: public, max-age=' . $cache_config['duration']);
        header('Expires: ' . gmdate('D, d M Y H:i:s \G\M\T', time() + $cache_config['duration']));
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s \G\M\T', filemtime($_SERVER['SCRIPT_FILENAME'])));
    }
    
    // Headers de compresión
    if ($compression_config['gzip'] && extension_loaded('zlib') && !ob_get_level()) {
        if (isset($_SERVER['HTTP_ACCEPT_ENCODING']) && strpos($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip') !== false) {
            ob_start('ob_gzhandler');
        }
    }
    
    // Headers de seguridad
    if ($security_config['csp']) {
        header("Content-Security-Policy: default-src 'self'; script-src 'self' 'unsafe-inline'; style-src 'self' 'unsafe-inline'; img-src 'self' data: https:; font-src 'self' data:;");
    }
    
    if ($security_config['hsts']) {
        header('Strict-Transport-Security: max-age=31536000; includeSubDomains');
    }
    
    if ($security_config['xss_protection']) {
        header('X-XSS-Protection: 1; mode=block');
    }
    
    if ($security_config['content_type_options']) {
        header('X-Content-Type-Options: nosniff');
    }
    
    if ($security_config['frame_options']) {
        header('X-Frame-Options: SAMEORIGIN');
    }
}

/**
 * Generar datos estructurados para SEO
 */
function generateStructuredData($type = 'organization') {
    $data = [
        '@context' => 'https://schema.org',
        '@type' => 'Organization',
        'name' => 'Rochas Energy',
        'url' => 'https://rochasenergy.com',
        'logo' => 'https://rochasenergy.com/assets/images/logo.png',
        'description' => 'Asesoría energética personalizada para ahorrar en tu factura de luz',
        'address' => [
            '@type' => 'PostalAddress',
            'addressLocality' => 'Tortosa',
            'addressCountry' => 'ES'
        ],
        'contactPoint' => [
            '@type' => 'ContactPoint',
            'telephone' => '+34600000000',
            'contactType' => 'customer service',
            'email' => 'info@rochasenergy.com'
        ],
        'sameAs' => [
            'https://www.google.com/maps?cid=YOUR_GOOGLE_MY_BUSINESS_ID'
        ]
    ];
    
    return json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
}

/**
 * Optimizar imágenes
 */
function optimizeImage($src, $alt = '', $class = '', $lazy = true) {
    global $image_config;
    
    $loading = $lazy && $image_config['lazy_loading'] ? 'loading="lazy"' : '';
    $class = $class ? 'class="' . htmlspecialchars($class) . '"' : '';
    
    return sprintf(
        '<img src="%s" alt="%s" %s %s>',
        htmlspecialchars($src),
        htmlspecialchars($alt),
        $class,
        $loading
    );
}

/**
 * Minificar HTML
 */
function minifyHTML($html) {
    global $compression_config;
    
    if (!$compression_config['minify_html']) {
        return $html;
    }
    
    // Eliminar comentarios HTML
    $html = preg_replace('/<!--(?!\s*(?:\[if [^\]]+]|<!|>))(?:(?!-->).)*-->/s', '', $html);
    
    // Eliminar espacios en blanco innecesarios
    $html = preg_replace('/\s+/', ' ', $html);
    $html = preg_replace('/>\s+</', '><', $html);
    
    return trim($html);
}

/**
 * Verificar si el usuario está en móvil
 */
function isMobile() {
    return isset($_SERVER['HTTP_USER_AGENT']) && 
           (preg_match('/Mobile|Android|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i', $_SERVER['HTTP_USER_AGENT']));
}

/**
 * Aplicar optimizaciones específicas para móvil
 */
function applyMobileOptimizations() {
    if (isMobile()) {
        // Reducir animaciones en móvil
        echo '<style>
            .energy-particle { animation-duration: 2s !important; }
            .service-card { transition-duration: 0.2s !important; }
        </style>';
    }
}

/**
 * Función de optimización general de rendimiento (compatibilidad)
 */
function optimizePerformance() {
    // Configurar límites de memoria si es necesario
    if (isDevelopment()) {
        ini_set('memory_limit', '256M');
    }
    
    // Configurar límites de tiempo de ejecución
    set_time_limit(30);
    
    // Configurar zona horaria
    date_default_timezone_set('Europe/Madrid');
    
    // Configurar encoding
    ini_set('default_charset', 'UTF-8');
}

/**
 * Función para medir el tiempo de ejecución
 */
function startTimer() {
    return microtime(true);
}

function endTimer($start_time) {
    return microtime(true) - $start_time;
}

/**
 * Función para optimizar la salida HTML
 */
function optimizeOutput($html) {
    global $compression_config;
    
    if (!$compression_config['minify_html']) {
        return $html;
    }
    
    // Eliminar espacios en blanco innecesarios
    $html = preg_replace('/\s+/', ' ', $html);
    $html = preg_replace('/>\s+</', '><', $html);
    
    // Eliminar comentarios HTML (excepto los importantes)
    $html = preg_replace('/<!--(?!\s*(?:\[if [^\]]+]|<!|>))(?:(?!-->).)*-->/s', '', $html);
    
    return trim($html);
}

/**
 * Función para comprimir la salida
 */
function compressOutput($content) {
    global $compression_config;
    
    // Solo aplicar compresión si no hay un buffer activo y no hay compresión ya configurada
    if ($compression_config['gzip'] && extension_loaded('zlib') && !ob_get_level() && !ini_get('zlib.output_compression') && !ini_get('output_handler')) {
        ini_set('zlib.output_compression', 1);
    }
    return $content;
}

/**
 * Función para establecer headers de caché
 */
function setCacheHeaders($duration = 3600) {
    global $cache_config;
    
    if ($cache_config['enabled'] && !isDevelopment()) {
        header('Cache-Control: public, max-age=' . $duration);
        header('Expires: ' . gmdate('D, d M Y H:i:s \G\M\T', time() + $duration));
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s \G\M\T', filemtime($_SERVER['SCRIPT_FILENAME'])));
    } else {
        header('Cache-Control: no-cache, no-store, must-revalidate');
        header('Pragma: no-cache');
        header('Expires: 0');
    }
}



// Aplicar optimizaciones automáticamente
if (!headers_sent()) {
    applyPerformanceOptimizations();
}
?>
