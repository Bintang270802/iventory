<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    private const JSON_FILE = 'products.json';

    /**
     * Display the main page
     */
    public function index()
    {
        return view('products.index');
    }

    /**
     * Store a new product
     */
    public function store(Request $request)
    {
        $validated = $this->validateProduct($request);
        
        $products = $this->getProducts();
        $newProduct = $this->createProduct($validated);
        
        $products[] = $newProduct;
        $this->saveProducts($products);

        return response()->json([
            'success' => true,
            'message' => 'Product added successfully',
            'product' => $newProduct,
        ]);
    }

    /**
     * Get all products with total sum
     */
    public function list()
    {
        $products = $this->getProducts();
        $products = $this->sortByDatetime($products);
        $totalSum = $this->calculateTotalSum($products);

        return response()->json([
            'success' => true,
            'products' => $products,
            'total_sum' => $totalSum,
        ]);
    }

    /**
     * Update an existing product
     */
    public function update(Request $request, $id)
    {
        $validated = $this->validateProduct($request);
        
        $products = $this->getProducts();
        $updated = $this->updateProduct($products, $id, $validated);

        if (!$updated) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found',
            ], 404);
        }

        $this->saveProducts($products);

        return response()->json([
            'success' => true,
            'message' => 'Product updated successfully',
        ]);
    }

    /**
     * Delete a product
     */
    public function destroy($id)
    {
        $products = $this->getProducts();
        $products = $this->removeProduct($products, $id);
        
        $this->saveProducts($products);

        return response()->json([
            'success' => true,
            'message' => 'Product deleted successfully',
        ]);
    }

    /**
     * Validate product data
     */
    private function validateProduct(Request $request)
    {
        return $request->validate([
            'product_name' => 'required|string|max:255',
            'quantity' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:0',
        ]);
    }

    /**
     * Create a new product array
     */
    private function createProduct(array $data)
    {
        $quantity = (float) $data['quantity'];
        $price = (float) $data['price'];

        return [
            'id' => uniqid(),
            'product_name' => $data['product_name'],
            'quantity' => $quantity,
            'price' => $price,
            'datetime' => now()->format('Y-m-d H:i:s'),
            'total_value' => $this->calculateTotalValue($quantity, $price),
        ];
    }

    /**
     * Update product in array
     */
    private function updateProduct(array &$products, string $id, array $data)
    {
        foreach ($products as &$product) {
            if ($product['id'] === $id) {
                $quantity = (float) $data['quantity'];
                $price = (float) $data['price'];

                $product['product_name'] = $data['product_name'];
                $product['quantity'] = $quantity;
                $product['price'] = $price;
                $product['total_value'] = $this->calculateTotalValue($quantity, $price);
                
                return true;
            }
        }

        return false;
    }

    /**
     * Remove product from array
     */
    private function removeProduct(array $products, string $id)
    {
        $filtered = array_filter($products, function ($product) use ($id) {
            return $product['id'] !== $id;
        });

        return array_values($filtered);
    }

    /**
     * Sort products by datetime (newest first)
     */
    private function sortByDatetime(array $products)
    {
        usort($products, function ($a, $b) {
            return strtotime($b['datetime']) - strtotime($a['datetime']);
        });

        return $products;
    }

    /**
     * Calculate total value (quantity * price)
     */
    private function calculateTotalValue(float $quantity, float $price)
    {
        return $quantity * $price;
    }

    /**
     * Calculate sum of all total values
     */
    private function calculateTotalSum(array $products)
    {
        return array_sum(array_column($products, 'total_value'));
    }

    /**
     * Get all products from JSON file
     */
    private function getProducts()
    {
        if (!Storage::exists(self::JSON_FILE)) {
            return [];
        }

        $content = Storage::get(self::JSON_FILE);
        return json_decode($content, true) ?? [];
    }

    /**
     * Save products to JSON file
     */
    private function saveProducts(array $products)
    {
        Storage::put(self::JSON_FILE, json_encode($products, JSON_PRETTY_PRINT));
    }
}
