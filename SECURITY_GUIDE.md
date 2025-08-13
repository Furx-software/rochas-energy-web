# 🔒 Guía de Seguridad y Monitoreo - Rochas Energy

## 📋 **Resumen de Implementaciones**

### ✅ **Medidas de Seguridad Implementadas**

#### **1. Headers de Seguridad HTTP**
- **Content Security Policy (CSP)** - Protección contra XSS
- **HSTS** - Forzar HTTPS (max-age=31536000)
- **X-XSS-Protection** - Protección adicional contra XSS
- **X-Content-Type-Options** - Prevenir MIME sniffing
- **X-Frame-Options** - Protección contra clickjacking
- **Referrer-Policy** - Control de referrers
- **Permissions-Policy** - Control de permisos del navegador

#### **2. Configuración HTTPS**
```apache
# Redirección automática a HTTPS
RewriteCond %{HTTPS} off
RewriteCond %{HTTP_HOST} !^localhost [NC]
RewriteCond %{HTTP_HOST} !^127\.0\.0\.1 [NC]
RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
```

#### **3. Protección de Archivos**
- Bloqueo de acceso a archivos sensibles (`.log`, `.env`, `config/*`)
- Compresión GZIP habilitada
- Caché optimizado para archivos estáticos

#### **4. Validación de Entrada**
- `htmlspecialchars()` en todos los datos de salida
- `filter_var()` para validación de emails
- Sanitización de datos en formularios
- Validación de longitud de mensajes

#### **5. Sistema de Email Seguro**
- Rate limiting (máximo 3 intentos por hora)
- Validación de credenciales antes de envío
- Logging de intentos con IP
- Timeout configurado (30 segundos)

#### **6. Gestión de Cookies**
- Configuración segura con `secure: true`
- `SameSite=Lax` para protección CSRF
- `HttpOnly` configurado cuando es posible

## 📊 **Sistema de Monitoreo de Logs**

### **Archivos de Log Creados**
- `logs/security.log` - Eventos de seguridad
- `logs/errors.log` - Errores de aplicación
- `logs/access.log` - Accesos y navegación
- `logs/email.log` - Actividad de email
- `logs/performance.log` - Métricas de rendimiento

### **Funciones de Logging Disponibles**
```php
// Log de errores de seguridad
logSecurityEvent($event, $details);

// Log de errores de aplicación
logError($error, $context);

// Log de acceso
logAccess($action, $details);

// Log de emails
logEmail($action, $details);

// Log de rendimiento
logPerformance($action, $duration, $details);
```

### **Características del Sistema de Logs**
- **Rotación automática** (máximo 5 archivos de 10MB cada uno)
- **Niveles de log** (ERROR, WARNING, INFO, DEBUG)
- **Alertas automáticas** (10 errores por hora)
- **Limpieza automática** (logs de más de 30 días)
- **Formato JSON** para fácil procesamiento

## 🛡️ **Panel de Administración**

### **Acceso al Panel**
- URL: `/admin/logs-viewer.php`
- **IMPORTANTE**: En producción, añadir autenticación

### **Funcionalidades del Panel**
- **Estadísticas en tiempo real** (Total, Errores, Advertencias, Info, Seguridad)
- **Filtros por categoría** y período de tiempo
- **Visualización de logs** en tabla interactiva
- **Exportación de logs**
- **Limpieza de logs antiguos**
- **Auto-refresh** cada 30 segundos

## 🔧 **Configuración para Producción**

### **1. Configurar Credenciales de Email**
```php
// En config/email.php
'smtp_username' => 'tu-email@gmail.com',
'smtp_password' => 'tu-contraseña-de-aplicación',
```

### **2. Habilitar Alertas por Email**
```php
// En config/logging.php
'alerts' => [
    'enabled' => true,
    'email_alerts' => true, // Cambiar a true
    'alert_threshold' => 10,
    'alert_window' => 3600
]
```

### **3. Configurar Autenticación del Panel**
```php
// En admin/logs-viewer.php
if (!isDevelopment()) {
    // Añadir verificación de autenticación
    if (!isAuthenticated()) {
        header('Location: /login');
        exit;
    }
}
```

### **4. Configurar SSL/TLS**
- Obtener certificado SSL válido
- Configurar redirección HTTPS en servidor
- Verificar que todos los recursos usen HTTPS

## 📈 **Monitoreo y Mantenimiento**

### **Tareas Diarias**
- Revisar logs de errores
- Verificar intentos de acceso no autorizado
- Monitorear rendimiento del sitio

### **Tareas Semanales**
- Revisar estadísticas de seguridad
- Verificar logs de email
- Analizar patrones de acceso

### **Tareas Mensuales**
- Limpiar logs antiguos
- Revisar configuración de seguridad
- Actualizar documentación

## 🚨 **Alertas y Respuesta a Incidentes**

### **Alertas Automáticas**
- **10 errores por hora** → Alerta automática
- **Intentos de acceso no autorizado** → Log de seguridad
- **Fallos en envío de email** → Log de error

### **Respuesta a Incidentes**
1. **Identificar** el tipo de incidente
2. **Contener** el problema
3. **Investigar** usando logs
4. **Resolver** el problema
5. **Documentar** la solución
6. **Prevenir** futuros incidentes

## 📞 **Contactos de Emergencia**

### **Desarrollo**
- **Email**: [tu-email@dominio.com]
- **Teléfono**: [tu-teléfono]

### **Hosting/Servidor**
- **Proveedor**: [nombre-del-proveedor]
- **Soporte**: [contacto-del-soporte]

## 🔍 **Herramientas de Análisis**

### **Análisis de Logs**
```bash
# Ver logs de seguridad
tail -f logs/security.log

# Buscar errores recientes
grep "ERROR" logs/errors.log | tail -20

# Analizar accesos por IP
grep "Page loaded" logs/access.log | awk '{print $NF}' | sort | uniq -c
```

### **Monitoreo de Rendimiento**
- **Tiempo de respuesta** del servidor
- **Uso de memoria** y CPU
- **Errores 404/500**
- **Tasa de éxito** de emails

## 📚 **Recursos Adicionales**

### **Documentación de Seguridad**
- [OWASP Top 10](https://owasp.org/www-project-top-ten/)
- [Mozilla Security Guidelines](https://infosec.mozilla.org/guidelines/)
- [PHP Security Best Practices](https://www.php.net/manual/en/security.php)

### **Herramientas de Testing**
- [OWASP ZAP](https://owasp.org/www-project-zap/) - Testing de seguridad
- [SSL Labs](https://www.ssllabs.com/ssltest/) - Test de SSL
- [Security Headers](https://securityheaders.com/) - Verificación de headers

---

**Última actualización**: <?php echo date('d/m/Y H:i:s'); ?>

**Versión**: 1.0

**Responsable**: Equipo de Desarrollo Rochas Energy
