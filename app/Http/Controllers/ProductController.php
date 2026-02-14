<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    private $jsonFile = 'products.json';

    public function index()
    {
        return view('products.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'quantity' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:0',
        ]);

        $products = $this->getProducts();

        $newProduct = [
            'id' => uniqid(),
            'product_name' => $request->product_name,
            'quantity' => (float) $request->quantity,
            'price' => (float) $request->price,
            'datetime' => now()->format('Y-m-d H:i:s'),
            'total_value' => (float) $request->quantity * (float) $request->price,
        ];

        $products[] = $newProduct;
        $this->saveProducts($products);

        return response()->json([
            'success' => true,
            'message' => 'Product added successfully',
            'product' => $newProduct,
        ]);
    }

    public function list()
    {
        $products = $this->getProducts();
        
        // Sort by datetime descending (newest first)
        usort($products, function ($a, $b) {
            return strtotime($b['datetime']) - strtotime($a['datetime']);
        });

        $totalSum = array_sum(array_column($products, 'total_value'));

        return response()->json([
            'success' => true,
            'products' => $products,
            'total_sum' => $totalSum,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'quantity' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:0',
        ]);

        $products = $this->getProducts();
        $updated = false;

        foreach ($products as &$product) {
            if ($product['id'] === $id) {
                $product['product_name'] = $request->product_name;
                $product['quantity'] = (float) $request->quantity;
                $product['price'] = (float) $request->price;
                $product['total_value'] = (float) $request->quantity * (float) $request->price;
                $updated = true;
                break;
            }
        }

        if ($updated) {
            $this->saveProducts($products);
            return response()->json([
                'success' => true,
                'message' => 'Product updated successfully',
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Product not found',
        ], 404);
    }

    public function destroy($id)
    {
        $products = $this->getProducts();
        $products = array_filter($products, function ($product) use ($id) {
            return $product['id'] !== $id;
        });

        $this->saveProducts(array_values($products));

        return response()->json([
            'success' => true,
            'message' => 'Product deleted successfully',
        ]);
    }

    private function getProducts()
    {
        if (!Storage::exists($this->jsonFile)) {
            return [];
        }

        $content = Storage::get($this->jsonFile);
        return json_decode($content, true) ?? [];
    }

    private function saveProducts($products)
    {
        Storage::put($this->jsonFile, json_encode($products, JSON_PRETTY_PRINT));
    }
}
