<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Product Inventory Management</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            background: #f5f5f0;
            background-image: 
                linear-gradient(90deg, rgba(200,200,190,0.03) 1px, transparent 1px),
                linear-gradient(rgba(200,200,190,0.03) 1px, transparent 1px);
            background-size: 20px 20px;
            min-height: 100vh;
            padding: 50px 0;
            font-family: 'Georgia', 'Times New Roman', serif;
            color: #2c2c2c;
        }
        
        .main-container {
            background: #ffffff;
            border: 1px solid #d4d4d0;
            box-shadow: 
                0 1px 3px rgba(0,0,0,0.05),
                0 10px 40px rgba(0,0,0,0.08);
            padding: 50px 60px;
            max-width: 1300px;
            margin: 0 auto;
            position: relative;
        }
        
        .main-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #8b7355 0%, #6b5d52 50%, #8b7355 100%);
        }
        
        .page-header {
            text-align: center;
            margin-bottom: 50px;
            padding-bottom: 30px;
            border-bottom: 2px solid #e8e8e4;
            position: relative;
        }
        
        .page-header::after {
            content: '◆';
            position: absolute;
            bottom: -12px;
            left: 50%;
            transform: translateX(-50%);
            background: #ffffff;
            padding: 0 15px;
            color: #8b7355;
            font-size: 1.2rem;
        }
        
        .page-header h1 {
            color: #2c2c2c;
            font-weight: 400;
            font-size: 2.5rem;
            margin-bottom: 12px;
            letter-spacing: 1px;
            text-transform: uppercase;
            font-family: 'Georgia', serif;
        }
        
        .page-header h1 i {
            color: #8b7355;
            margin-right: 15px;
            font-size: 2.2rem;
        }
        
        .page-header p {
            color: #6c6c6c;
            font-size: 1rem;
            font-style: italic;
            font-family: 'Georgia', serif;
            letter-spacing: 0.5px;
        }
        
        .form-section {
            background: #fafaf8;
            padding: 40px;
            margin-bottom: 50px;
            border: 1px solid #e0e0dc;
            border-left: 4px solid #8b7355;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        }
        
        .form-section h3 {
            color: #2c2c2c;
            margin-bottom: 30px;
            font-weight: 400;
            font-size: 1.5rem;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            font-family: 'Georgia', serif;
            border-bottom: 1px solid #e0e0dc;
            padding-bottom: 15px;
        }
        
        .form-section h3 i {
            color: #8b7355;
            margin-right: 10px;
        }
        
        .form-label {
            font-weight: 600;
            color: #3c3c3c;
            margin-bottom: 8px;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-family: 'Segoe UI', sans-serif;
        }
        
        .form-control {
            border-radius: 2px;
            border: 1px solid #c8c8c4;
            padding: 12px 16px;
            transition: all 0.3s ease;
            background: #ffffff;
            font-family: 'Segoe UI', sans-serif;
            font-size: 0.95rem;
        }
        
        .form-control:focus {
            border-color: #8b7355;
            box-shadow: 0 0 0 3px rgba(139, 115, 85, 0.1);
            outline: none;
            background: #fffffe;
        }
        
        .btn-primary {
            background: #8b7355;
            border: 1px solid #7a6449;
            padding: 12px 35px;
            border-radius: 2px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.9rem;
            font-family: 'Segoe UI', sans-serif;
            color: #ffffff;
        }
        
        .btn-primary:hover {
            background: #7a6449;
            border-color: #6b5539;
            box-shadow: 0 4px 12px rgba(139, 115, 85, 0.3);
            transform: translateY(-1px);
        }
        
        .btn-primary:active {
            transform: translateY(0);
        }
        
        .table-section h3 {
            color: #2c2c2c;
            margin-bottom: 30px;
            font-weight: 400;
            font-size: 1.5rem;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            font-family: 'Georgia', serif;
            border-bottom: 1px solid #e0e0dc;
            padding-bottom: 15px;
        }
        
        .table-section h3 i {
            color: #8b7355;
            margin-right: 10px;
        }
        
        .table {
            border: 1px solid #e0e0dc;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            margin-bottom: 0;
        }
        
        .table thead {
            background: #2c2c2c;
            color: #ffffff;
        }
        
        .table thead th {
            border: none;
            padding: 18px 15px;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 1px;
            font-family: 'Segoe UI', sans-serif;
            border-right: 1px solid rgba(255,255,255,0.1);
        }
        
        .table thead th:last-child {
            border-right: none;
        }
        
        .table tbody tr {
            transition: all 0.2s ease;
            border-bottom: 1px solid #e8e8e4;
        }
        
        .table tbody tr:hover {
            background-color: #fafaf8;
        }
        
        .table tbody td {
            padding: 16px 15px;
            vertical-align: middle;
            color: #3c3c3c;
            font-family: 'Segoe UI', sans-serif;
            font-size: 0.95rem;
        }
        
        .table tbody td strong {
            color: #2c2c2c;
            font-weight: 600;
        }
        
        .table tfoot {
            background-color: #2c2c2c;
            color: #ffffff;
            font-weight: 700;
            font-size: 1.1rem;
        }
        
        .table tfoot td {
            padding: 20px 15px;
            border-top: 2px solid #8b7355;
            font-family: 'Georgia', serif;
        }
        
        .btn-sm {
            padding: 7px 14px;
            border-radius: 2px;
            font-size: 0.85rem;
            transition: all 0.2s ease;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-family: 'Segoe UI', sans-serif;
        }
        
        .btn-warning {
            background-color: #d4a574;
            border: 1px solid #c49564;
            color: #2c2c2c;
        }
        
        .btn-warning:hover {
            background-color: #c49564;
            border-color: #b48554;
            color: #2c2c2c;
            box-shadow: 0 2px 8px rgba(212, 165, 116, 0.4);
        }
        
        .btn-danger {
            background-color: #a44a3f;
            border: 1px solid #8f3f35;
        }
        
        .btn-danger:hover {
            background-color: #8f3f35;
            border-color: #7a342b;
            box-shadow: 0 2px 8px rgba(164, 74, 63, 0.4);
        }
        
        .btn-success {
            background-color: #6b8e6b;
            border: 1px solid #5a7a5a;
        }
        
        .btn-success:hover {
            background-color: #5a7a5a;
            border-color: #4a6a4a;
        }
        
        .btn-secondary {
            background-color: #6c6c6c;
            border: 1px solid #5c5c5c;
        }
        
        .btn-secondary:hover {
            background-color: #5c5c5c;
            border-color: #4c4c4c;
        }
        
        .alert {
            border-radius: 2px;
            border-left: 4px solid;
            padding: 16px 20px;
            margin-bottom: 25px;
            font-family: 'Segoe UI', sans-serif;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        }
        
        .alert-success {
            background-color: #f0f5f0;
            border-left-color: #6b8e6b;
            color: #3c5c3c;
        }
        
        .alert-danger {
            background-color: #f8f0f0;
            border-left-color: #a44a3f;
            color: #6c2c2c;
        }
        
        .empty-state {
            text-align: center;
            padding: 80px 20px;
            color: #8c8c8c;
            background: #fafaf8;
            border: 1px dashed #d4d4d0;
        }
        
        .empty-state i {
            font-size: 4.5rem;
            margin-bottom: 25px;
            opacity: 0.3;
            color: #8b7355;
        }
        
        .empty-state h4 {
            color: #4c4c4c;
            font-family: 'Georgia', serif;
            font-weight: 400;
            margin-bottom: 10px;
        }
        
        .empty-state p {
            font-style: italic;
            font-family: 'Georgia', serif;
        }
        
        .loading {
            text-align: center;
            padding: 60px;
            color: #8b7355;
        }
        
        .spinner-border {
            width: 3rem;
            height: 3rem;
            border-color: #8b7355;
            border-right-color: transparent;
        }
        
        .modal-content {
            border-radius: 2px;
            border: 1px solid #d4d4d0;
            box-shadow: 0 10px 40px rgba(0,0,0,0.15);
        }
        
        .modal-header {
            background: #2c2c2c !important;
            color: white !important;
            border-bottom: 2px solid #8b7355;
            padding: 20px 25px;
        }
        
        .modal-title {
            font-family: 'Georgia', serif;
            font-weight: 400;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }
        
        .modal-body {
            padding: 30px 25px;
            background: #fafaf8;
        }
        
        .modal-footer {
            background: #f5f5f0;
            border-top: 1px solid #e0e0dc;
            padding: 20px 25px;
        }
        
        @media (max-width: 768px) {
            .main-container {
                padding: 30px 20px;
                margin: 0 15px;
            }
            
            .page-header h1 {
                font-size: 1.8rem;
            }
            
            .form-section {
                padding: 25px 20px;
            }
            
            .table {
                font-size: 0.85rem;
            }
            
            .btn-sm {
                padding: 5px 10px;
                font-size: 0.75rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="main-container">
            <!-- Header -->
            <div class="page-header">
                <h1><i class="bi bi-box-seam"></i> Product Inventory Management</h1>
                <p>Manage your product inventory with ease</p>
            </div>

            <!-- Alert Messages -->
            <div id="alertContainer"></div>

            <!-- Form Section -->
            <div class="form-section">
                <h3><i class="bi bi-plus-circle"></i> Add New Product</h3>
                <form id="productForm">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="product_name" class="form-label">Product Name</label>
                            <input type="text" class="form-control" id="product_name" name="product_name" required placeholder="Enter product name">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="quantity" class="form-label">Quantity in Stock</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" step="0.01" min="0" required placeholder="0">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="price" class="form-label">Price per Item</label>
                            <input type="number" class="form-control" id="price" name="price" step="0.01" min="0" required placeholder="0.00">
                        </div>
                        <div class="col-md-2 mb-3 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="bi bi-plus-lg"></i> Add
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Table Section -->
            <div class="table-section">
                <h3><i class="bi bi-table"></i> Product List</h3>
                <div id="tableContainer">
                    <div class="loading">
                        <div class="spinner-border" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="mt-3">Loading products...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel"><i class="bi bi-pencil-square"></i> Edit Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm">
                        <input type="hidden" id="edit_id">
                        <div class="mb-3">
                            <label for="edit_product_name" class="form-label">Product Name</label>
                            <input type="text" class="form-control" id="edit_product_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_quantity" class="form-label">Quantity in Stock</label>
                            <input type="number" class="form-control" id="edit_quantity" step="0.01" min="0" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_price" class="form-label">Price per Item</label>
                            <input type="number" class="form-control" id="edit_price" step="0.01" min="0" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success" onclick="updateProduct()">
                        <i class="bi bi-check-lg"></i> Save Changes
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // CSRF Token Setup
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            loadProducts();
            
            // Form Submit Handler
            document.getElementById('productForm').addEventListener('submit', function(e) {
                e.preventDefault();
                addProduct();
            });
        });

        // Show Alert
        function showAlert(message, type = 'success') {
            const alertHtml = `
                <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                    <i class="bi bi-${type === 'success' ? 'check-circle' : 'exclamation-triangle'}"></i>
                    ${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `;
            document.getElementById('alertContainer').innerHTML = alertHtml;
            
            // Auto dismiss after 5 seconds
            setTimeout(() => {
                const alert = document.querySelector('.alert');
                if (alert) {
                    alert.classList.remove('show');
                    setTimeout(() => alert.remove(), 150);
                }
            }, 5000);
        }

        // Add Product
        function addProduct() {
            const formData = {
                product_name: document.getElementById('product_name').value,
                quantity: document.getElementById('quantity').value,
                price: document.getElementById('price').value,
            };

            fetch('/products', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
                body: JSON.stringify(formData)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showAlert(data.message, 'success');
                    document.getElementById('productForm').reset();
                    loadProducts();
                } else {
                    showAlert('Error adding product', 'danger');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showAlert('Error adding product', 'danger');
            });
        }

        // Load Products
        function loadProducts() {
            fetch('/products/list', {
                headers: {
                    'Accept': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    renderTable(data.products, data.total_sum);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('tableContainer').innerHTML = `
                    <div class="alert alert-danger">
                        <i class="bi bi-exclamation-triangle"></i> Error loading products
                    </div>
                `;
            });
        }

        // Render Table
        function renderTable(products, totalSum) {
            const container = document.getElementById('tableContainer');
            
            if (products.length === 0) {
                container.innerHTML = `
                    <div class="empty-state">
                        <i class="bi bi-inbox"></i>
                        <h4>No Products Yet</h4>
                        <p>Start by adding your first product using the form above.</p>
                    </div>
                `;
                return;
            }

            let tableHtml = `
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Quantity in Stock</th>
                                <th>Price per Item</th>
                                <th>Datetime Submitted</th>
                                <th>Total Value</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
            `;

            products.forEach(product => {
                tableHtml += `
                    <tr>
                        <td><strong>${escapeHtml(product.product_name)}</strong></td>
                        <td>${formatNumber(product.quantity)}</td>
                        <td>$${formatNumber(product.price)}</td>
                        <td><small>${product.datetime}</small></td>
                        <td><strong>$${formatNumber(product.total_value)}</strong></td>
                        <td>
                            <button class="btn btn-warning btn-sm me-1" onclick="editProduct('${product.id}', '${escapeHtml(product.product_name)}', ${product.quantity}, ${product.price})" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <button class="btn btn-danger btn-sm" onclick="deleteProduct('${product.id}')" title="Delete">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>
                `;
            });

            tableHtml += `
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4" class="text-end">TOTAL SUM:</td>
                                <td colspan="2"><strong>$${formatNumber(totalSum)}</strong></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            `;

            container.innerHTML = tableHtml;
        }

        // Edit Product
        function editProduct(id, name, quantity, price) {
            document.getElementById('edit_id').value = id;
            document.getElementById('edit_product_name').value = name;
            document.getElementById('edit_quantity').value = quantity;
            document.getElementById('edit_price').value = price;
            
            const modal = new bootstrap.Modal(document.getElementById('editModal'));
            modal.show();
        }

        // Update Product
        function updateProduct() {
            const id = document.getElementById('edit_id').value;
            const formData = {
                product_name: document.getElementById('edit_product_name').value,
                quantity: document.getElementById('edit_quantity').value,
                price: document.getElementById('edit_price').value,
            };

            fetch(`/products/${id}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
                body: JSON.stringify(formData)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showAlert(data.message, 'success');
                    bootstrap.Modal.getInstance(document.getElementById('editModal')).hide();
                    loadProducts();
                } else {
                    showAlert('Error updating product', 'danger');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showAlert('Error updating product', 'danger');
            });
        }

        // Delete Product
        function deleteProduct(id) {
            if (!confirm('Are you sure you want to delete this product?')) {
                return;
            }

            fetch(`/products/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showAlert(data.message, 'success');
                    loadProducts();
                } else {
                    showAlert('Error deleting product', 'danger');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showAlert('Error deleting product', 'danger');
            });
        }

        // Utility Functions
        function formatNumber(num) {
            return parseFloat(num).toFixed(2);
        }

        function escapeHtml(text) {
            const map = {
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#039;'
            };
            return text.replace(/[&<>"']/g, m => map[m]);
        }
    </script>
</body>
</html>
