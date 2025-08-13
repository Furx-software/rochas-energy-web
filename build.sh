#!/bin/bash

# Instalar dependencias de Node.js
npm install

# Compilar Tailwind CSS
npm run build-prod

# Instalar Composer si no está disponible
if ! command -v composer &> /dev/null; then
    echo "Instalando Composer..."
    curl -sS https://getcomposer.org/installer | php
    php composer.phar install
else
    composer install
fi

echo "Build completado exitosamente!"
