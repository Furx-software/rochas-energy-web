# Rochas Web

Sitio web moderno desarrollado con HTML, Tailwind CSS y PHP con soporte multiidioma.

## 🚀 Características

- **Diseño Responsive**: Adaptado a todos los dispositivos
- **Multiidioma**: Soporte para español e inglés
- **Componentes Reutilizables**: Estructura modular para fácil mantenimiento
- **Tailwind CSS**: Framework CSS moderno y eficiente
- **PHP**: Backend para formularios y funcionalidades dinámicas
- **SEO Optimizado**: Meta tags y estructura semántica

## 📁 Estructura del Proyecto

```
rochas-web/
├── config/
│   └── languages.php          # Configuración de idiomas
├── components/
│   ├── head.php              # Componente head reutilizable
│   ├── navbar.php            # Navegación principal
│   └── footer.php            # Pie de página
├── src/
│   └── css/
│       └── input.css         # Archivo CSS de entrada para Tailwind
├── public/
│   └── css/
│       └── style.css         # CSS compilado (generado)
├── index.php                 # Página principal
├── servicios.php             # Página de servicios
├── contacto.php              # Página de contacto
├── package.json              # Dependencias de Node.js
├── tailwind.config.js        # Configuración de Tailwind
└── README.md                 # Este archivo
```

## 🛠️ Instalación

### Prerrequisitos

- Node.js (versión 14 o superior)
- PHP (versión 7.4 o superior)
- Servidor web (Apache, Nginx, o servidor de desarrollo de PHP)

### Pasos de Instalación

1. **Clonar o descargar el proyecto**
   ```bash
   git clone <url-del-repositorio>
   cd rochas-web
   ```

2. **Instalar dependencias de Node.js**
   ```bash
   npm install
   ```

3. **Compilar CSS de Tailwind**
   ```bash
   # Para desarrollo (con watch)
   npm run build
   
   # Para producción (minificado)
   npm run build-prod
   ```

4. **Configurar servidor web**
   
   **Opción A: Servidor de desarrollo de PHP**
   ```bash
   php -S localhost:8000
   ```
   
   **Opción B: Apache/Nginx**
   - Configurar el directorio raíz del proyecto
   - Asegurar que PHP esté habilitado

5. **Acceder al sitio**
   - Abrir navegador en `http://localhost:8000`

## 🌐 Sistema Multiidioma

El sitio soporta múltiples idiomas:

- **Español** (por defecto): `?lang=es`
- **Inglés**: `?lang=en`

### Agregar nuevos idiomas

1. Editar `config/languages.php`
2. Agregar el nuevo idioma al array `$available_languages`
3. Agregar las traducciones correspondientes en `getTranslations()`

## 🎨 Personalización

### Colores

Los colores principales se pueden modificar en `tailwind.config.js`:

```javascript
colors: {
  primary: {
    50: '#eff6ff',
    500: '#3b82f6',  // Color principal
    600: '#2563eb',
    700: '#1d4ed8',
  }
}
```

### Componentes

Los componentes están en la carpeta `components/` y se pueden reutilizar en cualquier página:

```php
<?php include 'components/navbar.php'; ?>
<?php include 'components/footer.php'; ?>
```

## 📝 Páginas Disponibles

- **Inicio** (`index.php`): Página principal con hero section y características
- **Servicios** (`servicios.php`): Lista de servicios ofrecidos
- **Contacto** (`contacto.php`): Formulario de contacto

## 🔧 Desarrollo

### Compilar CSS durante desarrollo

```bash
npm run build
```

Este comando compila Tailwind CSS y observa cambios en tiempo real.

### Estructura de componentes

Cada página sigue esta estructura:

```php
<?php
// Configuración de idioma
session_start();
require_once 'config/languages.php';

$current_lang = getCurrentLanguage();
$translations = getTranslations($current_lang);

// Meta tags de la página
$page_title = 'Título de la página';
$page_description = 'Descripción de la página';
?>

<?php include 'components/head.php'; ?>
<?php include 'components/navbar.php'; ?>

<!-- Contenido de la página -->

<?php include 'components/footer.php'; ?>
```

## 🚀 Despliegue

1. **Compilar para producción**
   ```bash
   npm run build-prod
   ```

2. **Subir archivos al servidor**
   - Subir todos los archivos excepto `node_modules/`
   - Asegurar que PHP esté configurado en el servidor

3. **Configurar servidor web**
   - Apache: Configurar `.htaccess` si es necesario
   - Nginx: Configurar proxy para PHP

## 📞 Soporte

Para soporte técnico o consultas:
- Email: info@rochasweb.com
- Documentación: [Enlace a documentación]

## 📄 Licencia

Este proyecto está bajo la Licencia MIT. Ver el archivo `LICENSE` para más detalles.

---

Desarrollado con ❤️ por FURX
