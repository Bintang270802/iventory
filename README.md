# Product Inventory Management System

Simple and elegant inventory management application built with Laravel and Bootstrap.

## Features

- Add products with name, quantity, and price
- View all products in a table
- Edit existing products
- Delete products
- Automatic total value calculation
- Real-time updates with AJAX
- Responsive design

## Requirements

- PHP 8.2 or higher
- Composer

## Installation

1. Clone the repository
```bash
git clone <repository-url>
cd inventory-management
```

2. Install dependencies
```bash
composer install
```

3. Setup environment
```bash
cp .env.example .env
php artisan key:generate
```

4. Start the server
```bash
php artisan serve
```

5. Open in browser
```
http://localhost:8000
```

## Quick Setup (Alternative)

**Windows:**
```bash
setup.bat
php artisan serve
```

**Linux/Mac:**
```bash
chmod +x setup.sh
./setup.sh
php artisan serve
```

## Usage

1. Fill in the form with product details
2. Click "Add" to save
3. Products appear in the table below
4. Use "Edit" button to modify
5. Use "Delete" button to remove

## Technology Stack

- Laravel 11
- PHP 8.2
- Bootstrap 5
- JavaScript (Vanilla)
- JSON file storage

## Data Storage

Products are stored in `storage/app/products.json` in JSON format.

## License

MIT License
