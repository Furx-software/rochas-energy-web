<?php
// Inicialización
session_start();
require_once 'config/app.php';
require_once 'config/languages.php';
require_once 'config/email.php';
require_once 'config/logging.php';

// Configurar headers para AJAX
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Solo permitir POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    
    // Log de intento de acceso no autorizado
    if (function_exists('logSecurityEvent')) {
        logSecurityEvent('Unauthorized access attempt', [
            'method' => $_SERVER['REQUEST_METHOD'],
            'ip' => $_SERVER['REMOTE_ADDR'] ?? 'unknown'
        ]);
    }
    
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
    exit;
}

// Obtener idioma actual
$current_lang = getCurrentLanguage();

// Obtener datos del formulario
$input = json_decode(file_get_contents('php://input'), true);

// Si no hay datos JSON, intentar con POST normal
if (!$input) {
    $input = $_POST;
}

// Validar datos requeridos
$name = trim($input['name'] ?? '');
$email = trim($input['email'] ?? '');
$message = trim($input['message'] ?? '');

// Validaciones
$errors = [];

if (empty($name)) {
    $errors['name'] = t('validation_required', 'contact');
}

if (empty($email)) {
    $errors['email'] = t('validation_required', 'contact');
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = t('validation_email', 'contact');
}

if (empty($message)) {
    $errors['message'] = t('validation_required', 'contact');
} elseif (strlen($message) < 10) {
    $errors['message'] = t('validation_min_length', 'contact');
}

// Si hay errores, devolverlos
if (!empty($errors)) {
    http_response_code(400);
    
    // Log de errores de validación
    if (function_exists('logError')) {
        logError('Form validation failed', [
            'errors' => $errors,
            'data' => ['name' => $name, 'email' => $email, 'message_length' => strlen($message)]
        ]);
    }
    
    echo json_encode([
        'success' => false,
        'message' => $current_lang === 'es' ? 'Por favor, corrige los errores del formulario' : 'Please correct the form errors',
        'errors' => $errors
    ]);
    exit;
}

// Verificar si PHPMailer está disponible
if (!isPHPMailerAvailable()) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => $current_lang === 'es' ? 'Sistema de email no disponible. Contacta directamente por teléfono.' : 'Email system not available. Please contact us by phone.'
    ]);
    exit;
}

// Enviar email
$result = sendContactEmail($name, $email, $message, $current_lang);

// Devolver resultado
if ($result['success']) {
    http_response_code(200);
    echo json_encode([
        'success' => true,
        'message' => t('success_message', 'contact')
    ]);
} else {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => $result['message']
    ]);
}
?>
