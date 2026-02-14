# API Documentation

Simple REST API documentation for the Product Inventory Management System.

## Base URL
```
http://localhost:8000
```

## Endpoints

### 1. Display Main Page
```
GET /
```
Returns the main HTML page with form and table.

---

### 2. Add Product
```
POST /products
```

**Request Body:**
```json
{
  "product_name": "Laptop",
  "quantity": 50,
  "price": 999.99
}
```

**Response:**
```json
{
  "success": true,
  "message": "Product added successfully",
  "product": {
    "id": "65d4f8a9b2c1e",
    "product_name": "Laptop",
    "quantity": 50,
    "price": 999.99,
    "datetime": "2026-02-15 10:30:00",
    "total_value": 49999.50
  }
}
```

---

### 3. Get All Products
```
GET /products/list
```

**Response:**
```json
{
  "success": true,
  "products": [
    {
      "id": "65d4f8a9b2c1e",
      "product_name": "Laptop",
      "quantity": 50,
      "price": 999.99,
      "datetime": "2026-02-15 10:30:00",
      "total_value": 49999.50
    }
  ],
  "total_sum": 49999.50
}
```

---

### 4. Update Product
```
PUT /products/{id}
```

**Request Body:**
```json
{
  "product_name": "Laptop Updated",
  "quantity": 100,
  "price": 899.99
}
```

**Response:**
```json
{
  "success": true,
  "message": "Product updated successfully"
}
```

---

### 5. Delete Product
```
DELETE /products/{id}
```

**Response:**
```json
{
  "success": true,
  "message": "Product deleted successfully"
}
```

## Data Structure

### Product Object
```json
{
  "id": "string (unique)",
  "product_name": "string",
  "quantity": "number",
  "price": "number",
  "datetime": "string (Y-m-d H:i:s)",
  "total_value": "number (quantity * price)"
}
```

## Validation Rules

- `product_name`: Required, string, max 255 characters
- `quantity`: Required, numeric, minimum 0
- `price`: Required, numeric, minimum 0

## Error Responses

**Validation Error:**
```json
{
  "message": "The given data was invalid.",
  "errors": {
    "product_name": ["The product name field is required."]
  }
}
```

**Not Found:**
```json
{
  "success": false,
  "message": "Product not found"
}
```

## CSRF Protection

All POST, PUT, DELETE requests require CSRF token in header:
```
X-CSRF-TOKEN: <token>
```

Token is available in meta tag:
```html
<meta name="csrf-token" content="...">
```

## Data Storage

Products are stored in JSON file:
```
storage/app/products.json
```

Format:
```json
[
  {
    "id": "...",
    "product_name": "...",
    "quantity": 0,
    "price": 0,
    "datetime": "...",
    "total_value": 0
  }
]
```
