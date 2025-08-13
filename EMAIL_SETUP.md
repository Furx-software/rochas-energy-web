# 📧 Configuración del Sistema de Email

## 🚀 Configuración Rápida

### 1. Editar Configuración
Abre el archivo `config/email.php` y configura tus credenciales:

```php
$email_config = [
    'smtp_host' => 'smtp.gmail.com',        // Tu servidor SMTP
    'smtp_port' => 587,                     // Puerto (587 para TLS, 465 para SSL)
    'smtp_encryption' => 'tls',             // 'tls' o 'ssl'
    'smtp_username' => 'tu-email@gmail.com', // Tu email
    'smtp_password' => 'tu-contraseña-app',  // Tu contraseña de aplicación
    // ... resto de configuración
];
```

### 2. Instalar PHPMailer
```bash
composer require phpmailer/phpmailer
```

## 📋 Configuraciones por Proveedor

### Gmail
```php
'smtp_host' => 'smtp.gmail.com',
'smtp_port' => 587,
'smtp_encryption' => 'tls',
'smtp_username' => 'tu-email@gmail.com',
'smtp_password' => 'contraseña-de-aplicación', // NO tu contraseña normal
```

**⚠️ Importante para Gmail:**
1. Activa la verificación en 2 pasos
2. Genera una "Contraseña de aplicación"
3. Usa esa contraseña, NO tu contraseña normal

### Outlook/Hotmail
```php
'smtp_host' => 'smtp-mail.outlook.com',
'smtp_port' => 587,
'smtp_encryption' => 'tls',
'smtp_username' => 'tu-email@outlook.com',
'smtp_password' => 'tu-contraseña',
```

### Yahoo
```php
'smtp_host' => 'smtp.mail.yahoo.com',
'smtp_port' => 587,
'smtp_encryption' => 'tls',
'smtp_username' => 'tu-email@yahoo.com',
'smtp_password' => 'contraseña-de-aplicación',
```

### Servidor propio
```php
'smtp_host' => 'tu-servidor.com',
'smtp_port' => 587,
'smtp_encryption' => 'tls',
'smtp_username' => 'tu-usuario',
'smtp_password' => 'tu-contraseña',
```

## 🔧 Configuración Avanzada

### Personalizar Destinatarios
```php
'to_email' => 'info@rochasenergy.com',     // Email que recibe los mensajes
'to_name' => 'Equipo Rochas Energy',       // Nombre del destinatario
'from_email' => 'info@rochasenergy.com',   // Email del remitente
'from_name' => 'Rochas Energy',            // Nombre del remitente
```

### Configuración de Seguridad
```php
'enable_verification' => true,             // Habilitar límite de intentos
'max_attempts' => 3,                       // Máximo 3 intentos por hora
'timeout' => 30,                           // Timeout de 30 segundos
```

## 🛠️ Instalación de PHPMailer

### Opción 1: Composer (Recomendado)
```bash
# Instalar Composer si no lo tienes
curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer

# Instalar PHPMailer
composer require phpmailer/phpmailer
```

### Opción 2: Descarga Manual
1. Descarga PHPMailer desde: https://github.com/PHPMailer/PHPMailer
2. Extrae en la carpeta `vendor/phpmailer/phpmailer/`
3. Asegúrate de que existe `vendor/autoload.php`

## 🧪 Pruebas

### 1. Verificar Configuración
```php
// Añade esto temporalmente en process-contact.php para debug
if (!isPHPMailerAvailable()) {
    echo "PHPMailer no está disponible";
    exit;
}
```

### 2. Probar Envío
1. Ve a la página de contacto
2. Rellena el formulario
3. Envía el mensaje
4. Verifica que recibes el email

### 3. Verificar Logs
Los intentos de envío se registran en `logs/email_attempts.json`

## 🔒 Seguridad

### Protecciones Implementadas
- ✅ Validación de datos de entrada
- ✅ Límite de intentos por email
- ✅ Sanitización de contenido
- ✅ Headers de seguridad
- ✅ Logs de intentos

### Recomendaciones
- Usa contraseñas de aplicación para Gmail
- Mantén actualizado PHPMailer
- Revisa los logs regularmente
- Usa HTTPS en producción

## 🐛 Solución de Problemas

### Error: "Credenciales no configuradas"
- Verifica que has cambiado `tu-email@gmail.com` por tu email real

### Error: "Authentication failed"
- Verifica usuario y contraseña
- Para Gmail: usa contraseña de aplicación, NO la normal

### Error: "Connection timeout"
- Verifica el host y puerto SMTP
- Comprueba tu conexión a internet

### Error: "PHPMailer no disponible"
- Instala PHPMailer con Composer
- Verifica que existe `vendor/autoload.php`

## 📞 Soporte

Si tienes problemas:
1. Revisa los logs en `logs/email_attempts.json`
2. Verifica la configuración SMTP
3. Prueba con un email de test
4. Contacta con soporte técnico

---

**¡Listo!** Una vez configurado, el formulario de contacto enviará emails automáticamente. 🎉
