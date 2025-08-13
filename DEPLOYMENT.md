# Guía de Despliegue en Render

## Configuración Actual

Este proyecto está configurado para desplegarse en Render usando Docker con las siguientes características:

- **PHP 8.1** con Apache
- **Tailwind CSS** compilado para producción
- **SQLite** para base de datos
- **Composer** para dependencias PHP
- **Node.js** para compilar assets

## Archivos de Configuración

### Dockerfile
- Usa la imagen oficial de PHP 8.1 con Apache
- Instala extensiones PHP necesarias (PDO, SQLite, ZIP)
- Compila Tailwind CSS durante el build
- Configura permisos y directorios

### render.yaml
- Configura el servicio web en Render
- Monta un disco persistente para datos SQLite
- Define variables de entorno
- Configura health check

## Pasos para Desplegar

### 1. Preparar el Repositorio
```bash
# Asegúrate de que todos los archivos estén committeados
git add .
git commit -m "Configuración para despliegue en Render"
git push origin main
```

### 2. Conectar con Render
1. Ve a [render.com](https://render.com)
2. Crea una nueva cuenta o inicia sesión
3. Haz clic en "New +" y selecciona "Web Service"
4. Conecta tu repositorio de GitHub/GitLab

### 3. Configurar el Servicio
- **Name**: `rochas-energy-web`
- **Environment**: `Docker`
- **Branch**: `main`
- **Root Directory**: (dejar vacío)
- **Dockerfile Path**: `./Dockerfile`

### 4. Variables de Entorno
Render automáticamente usará las variables definidas en `render.yaml`:
- `ENVIRONMENT=production`
- `PHP_VERSION=8.1`
- `APACHE_DOCUMENT_ROOT=/var/www/html/public`

### 5. Desplegar
1. Haz clic en "Create Web Service"
2. Render comenzará el build automáticamente
3. El proceso puede tomar 5-10 minutos

## Desarrollo Local

Para probar localmente antes de desplegar:

```bash
# Construir la imagen
docker build -t rochas-energy-web .

# Ejecutar el contenedor
docker run -p 8080:80 rochas-energy-web

# O usar docker-compose
docker-compose up --build
```

## Troubleshooting

### Problemas Comunes

1. **Build falla en npm install**
   - Verifica que `package.json` esté correcto
   - Asegúrate de que `src/css/input.css` existe

2. **Error de permisos**
   - Los permisos se configuran automáticamente en el Dockerfile
   - Verifica que los directorios `logs`, `admin`, `cache` existan

3. **Apache no sirve archivos**
   - Verifica que el `DocumentRoot` apunte a `/var/www/html/public`
   - Confirma que `mod_rewrite` esté habilitado

### Logs en Render
- Ve a tu servicio en Render
- Haz clic en "Logs" para ver logs en tiempo real
- Los logs de Apache están en `/var/log/apache2/`

## Optimizaciones

### Performance
- Tailwind CSS se compila y minifica durante el build
- Apache está configurado con compresión gzip
- Archivos estáticos tienen caché configurado

### Seguridad
- Solo se instalan dependencias de producción
- Permisos de archivos configurados correctamente
- Variables de entorno separadas

## Monitoreo

- **Health Check**: Render verifica `/` cada 30 segundos
- **Auto Deploy**: Se activa automáticamente en push a main
- **Logs**: Disponibles en el dashboard de Render
