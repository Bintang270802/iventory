# Installation Guide

## System Requirements

- PHP >= 8.2
- Composer
- Web server or PHP built-in server

## Step-by-Step Installation

### 1. Get the Code
```bash
git clone <repository-url>
cd inventory-management
```

### 2. Install Dependencies
```bash
composer install
```

### 3. Configure Environment
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Run the Application
```bash
php artisan serve
```

### 5. Access the Application
Open your browser and go to:
```
http://localhost:8000
```

## Automated Setup

### Windows
Double-click `setup.bat` or run:
```bash
setup.bat
```

### Linux/Mac
```bash
chmod +x setup.sh
./setup.sh
```

Then start the server:
```bash
php artisan serve
```

## Troubleshooting

### Port Already in Use
```bash
php artisan serve --port=8080
```

### Permission Issues (Linux/Mac)
```bash
chmod -R 775 storage bootstrap/cache
```

### Composer Not Found
Install Composer from: https://getcomposer.org

## Testing the Application

1. Add a product (e.g., "Laptop", 50, 999.99)
2. Verify it appears in the table
3. Edit the product
4. Delete the product
5. Check `storage/app/products.json` file

## Browser Support

- Chrome (recommended)
- Firefox
- Safari
- Edge
- Mobile browsers
