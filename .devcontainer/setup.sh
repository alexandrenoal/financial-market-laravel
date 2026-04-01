#!/bin/bash
set -e

# Instalar extensões PHP necessárias
sudo apt-get update && sudo apt-get install -y \
  php8.3-mbstring php8.3-xml php8.3-curl php8.3-zip \
  php8.3-mysql php8.3-pgsql php8.3-sqlite3

# Instalar Composer
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer

# Instalar Laravel (se ainda não existir)
if [ ! -f "artisan" ]; then
  composer create-project laravel/laravel . --prefer-dist
fi

# Instalar dependências
composer install
npm install

# Configurar .env
if [ ! -f ".env" ]; then
  cp .env.example .env
  php artisan key:generate
fi