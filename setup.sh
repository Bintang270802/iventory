#!/bin/bash

echo "========================================"
echo "Product Inventory Management System"
echo "Setup Script for Linux/Mac"
echo "========================================"
echo ""

echo "[1/5] Installing Composer dependencies..."
composer install --no-interaction --prefer-dist --optimize-autoloader
if [ $? -ne 0 ]; then
    echo "ERROR: Composer install failed!"
    exit 1
fi
echo ""

echo "[2/5] Setting up environment file..."
if [ ! -f .env ]; then
    cp .env.example .env
    echo "Environment file created."
else
    echo "Environment file already exists."
fi
echo ""

echo "[3/5] Generating application key..."
php artisan key:generate --force
if [ $? -ne 0 ]; then
    echo "ERROR: Key generation failed!"
    exit 1
fi
echo ""

echo "[4/5] Setting permissions..."
chmod -R 775 storage
chmod -R 775 bootstrap/cache
echo "Permissions set."
echo ""

echo "[5/5] Setup complete!"
echo ""
echo "========================================"
echo "To start the application, run:"
echo "    php artisan serve"
echo ""
echo "Then open your browser to:"
echo "    http://localhost:8000"
echo "========================================"
echo ""
