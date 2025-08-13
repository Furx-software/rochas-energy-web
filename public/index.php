<?php
// Inicialización única de la aplicación
session_start();
require_once ../'config/app.php';
require_once ../'config/languages.php';
require_once ../'config/routes.php';
require_once ../'config/performance.php';
require_once ../'config/logging.php';

// Optimizar rendimiento
optimizePerformance();

// Iniciar timer para medir rendimiento
$start_time = startTimer();

// Configuración inicial
$current_lang = getCurrentLanguage();

// Determinar qué página mostrar
$page = getPageContent();

// Configurar meta tags según la página
$meta_config = [
    'home' => ['home_title', 'home_description'],
    'servicios' => ['services_title', 'services_description'],
    'contacto' => ['contact_title', 'contact_description'],
    '404' => ['404_title', '404_description']
];

$page_config = $meta_config[$page] ?? $meta_config['404'];
$page_title = t($page_config[0], 'meta');
$page_description = t($page_config[1], 'meta');

// Configurar headers para 404 si es necesario
if ($page === '404') {
    http_response_code(404);
}

// Configurar timeout de sesión
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > getConfig('session_timeout'))) {
    session_unset();
    session_destroy();
}
$_SESSION['last_activity'] = time();

// Configurar headers de caché
setCacheHeaders();

// Iniciar buffer de salida para optimización
ob_start();
?>

<?php include ../'components/head.php'; ?>

<div class="flex flex-col min-h-screen bg-white">
    <?php include ../'components/navbar.php'; ?>

    <main class="flex-1">
        <?php include ../"pages/{$page}.php"; ?>
    </main>

    <?php include ../'components/footer.php'; ?>
    
    <!-- Banner de Cookies -->
    <?php include ../'components/cookie-banner.php'; ?>
</div>

</body>
</html>

<?php
// Obtener contenido del buffer
$content = ob_get_clean();

// Optimizar salida si no estamos en desarrollo
if (!isDevelopment()) {
    $content = optimizeOutput($content);
}

// Comprimir salida
$content = compressOutput($content);

// Mostrar contenido
echo $content;

// Medir tiempo de ejecución (solo en desarrollo)
if (isDevelopment()) {
    $execution_time = endTimer($start_time);
    if ($execution_time > 0.1) { // Si tarda más de 100ms
        error_log("Performance warning: Page loaded in {$execution_time}s");
    }
}
?>
