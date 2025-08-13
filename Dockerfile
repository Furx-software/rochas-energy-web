FROM php:8.1-apache

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    curl \
    git \
    unzip \
    nodejs \
    npm \
    libzip-dev \
    libsqlite3-dev \
    pkg-config \
    && rm -rf /var/lib/apt/lists/*

# Instalar extensiones PHP necesarias
RUN docker-php-ext-install pdo pdo_sqlite zip

# Habilitar mod_rewrite para Apache
RUN a2enmod rewrite

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Establecer directorio de trabajo
WORKDIR /var/www/html

# Copiar archivos del proyecto
COPY . .

# Instalar dependencias de Node.js
RUN npm install

# Compilar Tailwind CSS
RUN npm run build-prod

# Instalar dependencias de PHP
RUN composer install --no-dev --optimize-autoloader

# Crear directorios necesarios y configurar permisos FINALES
RUN mkdir -p logs admin cache && \
    chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html && \
    chmod -R 777 /var/www/html/logs && \
    chmod -R 777 /var/www/html/admin && \
    chmod -R 755 /var/www/html/cache

# Crear script de inicialización
RUN echo '#!/bin/bash\n\
if [ ! -f /var/www/html/admin/users.db ]; then\n\
    echo "Inicializando base de datos..."\n\
    php /var/www/html/public/admin/init-db-simple.php\n\
fi\n\
exec apache2-foreground' > /usr/local/bin/start.sh && \
chmod +x /usr/local/bin/start.sh

# Configurar Apache para servir desde el directorio public
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' /etc/apache2/sites-available/000-default.conf && \
    echo '<Directory /var/www/html/public>' >> /etc/apache2/sites-available/000-default.conf && \
    echo '    AllowOverride All' >> /etc/apache2/sites-available/000-default.conf && \
    echo '    Require all granted' >> /etc/apache2/sites-available/000-default.conf && \
    echo '</Directory>' >> /etc/apache2/sites-available/000-default.conf

# Exponer puerto
EXPOSE 80

# Comando de inicio
CMD ["/usr/local/bin/start.sh"]
