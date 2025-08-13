<?php
/**
 * Configuración del sistema de email - ARCHIVO DE EJEMPLO
 * 
 * IMPORTANTE: Copiar este archivo a config/email.php y configurar las credenciales reales
 * 
 * Comando para copiar:
 * cp config/email.example.php config/email.php
 */

// Configuración del servidor SMTP
$email_config = [
    // Servidor SMTP (ejemplos comunes)
    'smtp_host' => 'smtp.gmail.com',        // Gmail: smtp.gmail.com
    'smtp_port' => 587,                     // Puerto TLS: 587, SSL: 465
    'smtp_encryption' => 'tls',             // 'tls' o 'ssl'
    
    // Credenciales de autenticación
    'smtp_username' => 'tu-email@gmail.com', // Tu email
    'smtp_password' => 'tu-contraseña-app',  // Tu contraseña de aplicación
    
    // Configuración del remitente
    'from_email' => 'info@rochasenergy.com',
    'from_name' => 'Rochas Energy',
    
    // Email de destino para recibir los mensajes
    'to_email' => 'info@rochasenergy.com',
    'to_name' => 'Equipo Rochas Energy',
    
    // Configuración adicional
    'reply_to' => 'noreply@rochasenergy.com',
    'subject_prefix' => '[Contacto Web]',
    
    // Configuración de seguridad
    'enable_verification' => true,          // Habilitar verificación de email
    'max_attempts' => 3,                    // Máximo intentos por hora
    'timeout' => 30,                        // Timeout en segundos
];

// NOTA: Este archivo es solo un ejemplo.
// Para usar el sistema de email, copia este archivo a config/email.php
// y configura las credenciales reales de tu servidor SMTP.
?>
