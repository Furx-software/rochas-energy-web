# 🚀 Guía de Instalación - Rochas Energy

## 📋 **Requisitos Previos**

### **Servidor Web**
- **PHP**: 7.4 o superior
- **Extensiones PHP**: PDO, SQLite3, mbstring, json
- **Servidor Web**: Apache/Nginx
- **SSL**: Recomendado para producción

### **Node.js (Opcional)**
- **Node.js**: 14.x o superior (para desarrollo)
- **npm**: Para instalar dependencias de desarrollo

## 🔧 **Instalación**

### **1. Clonar el Repositorio**
```bash
git clone [URL_DEL_REPOSITORIO] rochas-web
cd rochas-web
```

### **2. Configurar Permisos**
```bash
# Crear directorios necesarios
mkdir -p logs admin cache uploads/temp

# Configurar permisos
chmod 755 logs admin cache uploads
chmod 644 .htaccess
```

### **3. Configurar Email (Opcional)**
```bash
# Copiar archivo de ejemplo
cp config/email.example.php config/email.php

# Editar configuración
nano config/email.php
```

**Configurar en `config/email.php`:**
```php
'smtp_username' => 'tu-email@gmail.com',
'smtp_password' => 'tu-contraseña-de-aplicación',
```

### **4. Instalar Dependencias (Opcional)**
```bash
# Si usas Node.js para desarrollo
npm install

# Si usas Composer para PHP
composer install
```

### **5. Configurar Base de Datos**
La base de datos SQLite se crea automáticamente al acceder por primera vez.

### **6. Configurar Servidor Web**

#### **Apache (.htaccess ya incluido)**
El archivo `.htaccess` ya está configurado para:
- URLs amigables
- Headers de seguridad
- Compresión GZIP
- Caché de archivos estáticos

#### **Nginx**
```nginx
server {
    listen 80;
    server_name tu-dominio.com;
    root /ruta/a/rochas-web;
    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php7.4-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }

    # Proteger archivos sensibles
    location ~ /\.(ht|env) {
        deny all;
    }

    location ~ /(config|admin|logs)/ {
        deny all;
    }
}
```

## 🔐 **Configuración de Seguridad**

### **1. Credenciales por Defecto**
- **Usuario**: `admin`
- **Contraseña**: `admin123`
- **URL**: `/admin/login.php`

**⚠️ IMPORTANTE**: Cambiar la contraseña inmediatamente después del primer login.

### **2. Configurar HTTPS**
```bash
# Obtener certificado SSL (Let's Encrypt)
sudo certbot --apache -d tu-dominio.com
```

### **3. Configurar Firewall**
```bash
# Permitir puertos necesarios
sudo ufw allow 80
sudo ufw allow 443
sudo ufw allow 22
```

## 📊 **Verificación de Instalación**

### **1. Verificar PHP**
```bash
php -v
php -m | grep -E "(pdo|sqlite|mbstring|json)"
```

### **2. Verificar Permisos**
```bash
ls -la logs/
ls -la admin/
ls -la cache/
```

### **3. Verificar Base de Datos**
```bash
# Verificar que se creó la base de datos
ls -la admin/users.db
```

### **4. Probar Funcionalidades**
- **Sitio principal**: `http://tu-dominio.com`
- **Panel admin**: `http://tu-dominio.com/admin/login.php`
- **Debug**: `http://tu-dominio.com/admin/debug-auth.php`

## 🔧 **Configuración de Desarrollo**

### **1. Modo Desarrollo**
```php
// En config/app.php
define('ENVIRONMENT', 'development');
```

### **2. Logs de Debug**
```bash
# Ver logs en tiempo real
tail -f logs/errors.log
tail -f logs/access.log
```

### **3. Base de Datos de Desarrollo**
```bash
# Backup de base de datos
cp admin/users.db admin/users.db.backup

# Restaurar base de datos
cp admin/users.db.backup admin/users.db
```

## 🚀 **Despliegue en Producción**

### **1. Configuración de Producción**
```php
// En config/app.php
define('ENVIRONMENT', 'production');
```

### **2. Optimizaciones**
```bash
# Comprimir CSS/JS
npm run build

# Limpiar caché
rm -rf cache/*
```

### **3. Backup Automático**
```bash
# Crear script de backup
nano backup.sh
chmod +x backup.sh

# Configurar cron
crontab -e
# Añadir: 0 2 * * * /ruta/a/rochas-web/backup.sh
```

### **4. Monitoreo**
- **Logs**: `/logs/`
- **Panel admin**: `/admin/logs-viewer.php`
- **Estadísticas**: `/admin/manage-users.php`

## 🛠️ **Mantenimiento**

### **1. Actualizaciones**
```bash
# Backup antes de actualizar
cp -r rochas-web rochas-web.backup

# Actualizar código
git pull origin main

# Verificar cambios
diff -r rochas-web rochas-web.backup
```

### **2. Limpieza de Logs**
```bash
# Limpiar logs antiguos (automático)
# O manualmente:
find logs/ -name "*.log" -mtime +30 -delete
```

### **3. Verificación de Seguridad**
```bash
# Verificar permisos
find . -type f -exec chmod 644 {} \;
find . -type d -exec chmod 755 {} \;

# Verificar archivos sensibles
ls -la config/email.php
ls -la admin/users.db
```

## 📞 **Soporte**

### **Contactos**
- **Email**: [tu-email@dominio.com]
- **Teléfono**: [tu-teléfono]

### **Documentación**
- **Guía de Seguridad**: `SECURITY_GUIDE.md`
- **Guía de Autenticación**: `AUTHENTICATION_GUIDE.md`
- **README Principal**: `README.md`

---

**Última actualización**: <?php echo date('d/m/Y H:i:s'); ?>

**Versión**: 1.0

**Responsable**: Equipo de Desarrollo Rochas Energy
