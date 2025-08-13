#!/bin/bash

# Script de build para producción
echo "🚀 Iniciando build de producción..."

# Instalar dependencias de Node.js
echo "📦 Instalando dependencias de Node.js..."
npm ci --only=production

# Compilar Tailwind CSS
echo "🎨 Compilando Tailwind CSS..."
npm run build-prod

# Instalar dependencias de PHP
echo "📦 Instalando dependencias de PHP..."
composer install --no-dev --optimize-autoloader

# Crear directorios necesarios
echo "📁 Creando directorios necesarios..."
mkdir -p logs admin cache

# Configurar permisos
echo "🔐 Configurando permisos..."
chmod -R 755 logs admin cache

echo "✅ Build completado exitosamente!"
