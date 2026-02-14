@echo off
echo ========================================
echo Product Inventory Management System
echo Setup Script for Windows
echo ========================================
echo.

echo [1/5] Installing Composer dependencies...
call composer install --no-interaction --prefer-dist --optimize-autoloader
if errorlevel 1 (
    echo ERROR: Composer install failed!
    pause
    exit /b 1
)
echo.

echo [2/5] Setting up environment file...
if not exist .env (
    copy .env.example .env
    echo Environment file created.
) else (
    echo Environment file already exists.
)
echo.

echo [3/5] Generating application key...
php artisan key:generate --force
if errorlevel 1 (
    echo ERROR: Key generation failed!
    pause
    exit /b 1
)
echo.

echo [4/5] Creating storage directories...
if not exist storage\app mkdir storage\app
if not exist storage\framework\cache\data mkdir storage\framework\cache\data
if not exist storage\framework\sessions mkdir storage\framework\sessions
if not exist storage\framework\views mkdir storage\framework\views
if not exist storage\logs mkdir storage\logs
echo Storage directories ready.
echo.

echo [5/5] Setup complete!
echo.
echo ========================================
echo To start the application, run:
echo     php artisan serve
echo.
echo Then open your browser to:
echo     http://localhost:8000
echo ========================================
echo.
pause
