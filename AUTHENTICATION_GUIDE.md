# 🔐 Guía de Autenticación - Panel de Administración

## 📋 **Resumen del Sistema**

### ✅ **Sistema de Autenticación Implementado**

#### **1. Base de Datos SQLite**
- **Archivo**: `admin/users.db`
- **Tablas**: `users`, `login_attempts`
- **Encriptación**: `password_hash()` con `PASSWORD_DEFAULT`
- **Sesiones**: Timeout configurable (1 hora por defecto)

#### **2. Características de Seguridad**
- **Rate Limiting**: Máximo 5 intentos fallidos por 15 minutos
- **Bloqueo temporal**: Cuentas bloqueadas automáticamente
- **Logging**: Todos los intentos de login registrados
- **Validación**: Contraseñas con requisitos mínimos
- **Roles**: Sistema de roles (admin, viewer)

#### **3. Archivos del Sistema**
- `config/auth.php` - Sistema principal de autenticación
- `admin/login.php` - Página de login
- `admin/logout.php` - Cerrar sesión
- `admin/logs-viewer.php` - Panel de logs (protegido)
- `admin/manage-users.php` - Gestión de usuarios
- `admin/clean-logs.php` - Limpieza de logs (protegido)

## 🔑 **Credenciales por Defecto**

### **Usuario Inicial**
- **Usuario**: `admin`
- **Contraseña**: `admin123`
- **Rol**: `admin`
- **Email**: `admin@rochasenergy.com`

### **⚠️ IMPORTANTE**
**Cambiar la contraseña por defecto inmediatamente después del primer login.**

## 🚀 **Acceso al Panel**

### **URLs del Sistema**
- **Login**: `/admin/login.php`
- **Panel de Logs**: `/admin/logs-viewer.php`
- **Gestión de Usuarios**: `/admin/manage-users.php`
- **Logout**: `/admin/logout.php`

### **Flujo de Acceso**
1. Navegar a `/admin/login.php`
2. Ingresar credenciales
3. Redirección automática al panel de logs
4. Acceso a todas las funcionalidades

## 🔧 **Configuración**

### **Configuración de Autenticación**
```php
// En config/auth.php
$auth_config = [
    'db_path' => 'admin/users.db',
    'session_timeout' => 3600, // 1 hora
    'max_login_attempts' => 5,
    'lockout_duration' => 900, // 15 minutos
    'password_min_length' => 8,
    'require_special_chars' => true
];
```

### **Requisitos de Contraseña**
- **Mínimo 8 caracteres**
- **Al menos 1 carácter especial** (`!@#$%^&*(),.?":{}|<>`)
- **Encriptación automática** con `password_hash()`

## 👥 **Gestión de Usuarios**

### **Crear Nuevo Usuario**
1. Acceder a `/admin/manage-users.php`
2. Completar formulario de creación
3. Asignar rol (admin/viewer)
4. Usuario creado automáticamente

### **Cambiar Contraseña**
1. En `/admin/manage-users.php`
2. Sección "Cambiar Mi Contraseña"
3. Verificar contraseña actual
4. Nueva contraseña con requisitos

### **Roles Disponibles**
- **admin**: Acceso completo a todas las funciones
- **viewer**: Solo visualización de logs (futuro)

## 📊 **Monitoreo de Seguridad**

### **Estadísticas de Login**
- **Total de intentos** (24h)
- **Logins exitosos**
- **Intentos fallidos**
- **IPs únicas**

### **Logs de Seguridad**
- **Intentos de login** (exitosos y fallidos)
- **Bloqueos de cuenta**
- **Cambios de contraseña**
- **Acciones de administración**

### **Alertas Automáticas**
- **5 intentos fallidos** → Bloqueo automático
- **15 minutos** → Desbloqueo automático
- **Logging** de todas las actividades

## 🛡️ **Protección del Directorio**

### **Configuración .htaccess**
```apache
# Proteger directorio admin
<Directory "admin">
    Order allow,deny
    Deny from all
</Directory>

# Permitir acceso a archivos PHP específicos
<Files "admin/*.php">
    Order allow,deny
    Allow from all
</Files>
```

### **Archivos Protegidos**
- ✅ `admin/users.db` - Base de datos SQLite
- ✅ `admin/logs/` - Directorio de logs
- ✅ `config/` - Archivos de configuración

## 🔍 **Funciones Disponibles**

### **Autenticación**
```php
// Verificar si está autenticado
isAuthenticated()

// Verificar rol
hasRole('admin')

// Autenticar usuario
authenticateUser($username, $password)

// Cerrar sesión
logout()
```

### **Gestión de Usuarios**
```php
// Crear usuario
createUser($username, $password, $email, $role)

// Cambiar contraseña
changePassword($user_id, $current_password, $new_password)

// Obtener usuario actual
getCurrentUser()

// Obtener estadísticas
getLoginStats($hours)
```

### **Logging de Seguridad**
```php
// Log de intentos de login
logLoginAttempt($username, $success)

// Verificar bloqueo
isUserLocked($username)

// Actualizar último login
updateLastLogin($user_id)
```

## 🚨 **Respuesta a Incidentes**

### **Cuenta Bloqueada**
1. **Esperar 15 minutos** para desbloqueo automático
2. **Verificar credenciales** correctas
3. **Revisar logs** en `/admin/logs-viewer.php`
4. **Contactar administrador** si persiste

### **Acceso No Autorizado**
1. **Revisar logs** de intentos de login
2. **Verificar IPs** sospechosas
3. **Cambiar contraseñas** si es necesario
4. **Monitorear** actividad futura

### **Pérdida de Acceso**
1. **Verificar base de datos** `admin/users.db`
2. **Crear nuevo usuario** administrador
3. **Restaurar desde backup** si es necesario
4. **Documentar** el incidente

## 📈 **Mantenimiento**

### **Tareas Diarias**
- Revisar estadísticas de login
- Verificar intentos fallidos
- Monitorear IPs sospechosas

### **Tareas Semanales**
- Revisar logs de seguridad
- Verificar usuarios activos
- Actualizar contraseñas si es necesario

### **Tareas Mensuales**
- Backup de base de datos
- Revisar configuración de seguridad
- Actualizar documentación

## 🔧 **Troubleshooting**

### **Error: "Error de base de datos"**
```bash
# Verificar permisos
chmod 755 admin/
chmod 644 admin/users.db

# Verificar SQLite
php -r "try { new PDO('sqlite:admin/users.db'); echo 'OK'; } catch(Exception \$e) { echo 'Error: ' . \$e->getMessage(); }"
```

### **Error: "Cuenta bloqueada"**
- Esperar 15 minutos
- Verificar intentos en logs
- Contactar administrador

### **Error: "Sesión expirada"**
- Volver a hacer login
- Verificar configuración de timeout
- Limpiar cookies del navegador

## 📞 **Contactos de Emergencia**

### **Administrador del Sistema**
- **Email**: [admin@rochasenergy.com]
- **Teléfono**: [699 48 71 78]

### **Acceso de Emergencia**
- **Usuario**: `admin`
- **Contraseña**: `admin123` (cambiar inmediatamente)

---

**Última actualización**: <?php echo date('d/m/Y H:i:s'); ?>

**Versión**: 1.0

**Responsable**: Equipo de Desarrollo Rochas Energy
