<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    /**
     * Store products temporarily in session.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function storeTemporaryProducts(Request $request)
    {
        $validated = $request->validate([
            'productName' => 'required|string',
            'productQuantity' => 'required|integer',
            'productWeight' => 'required|numeric',
        ]);
    
        $products = session()->get('products', []);
        $products[] = $validated;
        session()->put('products', $products);
    
        return response()->json([
            'message' => 'Product added temporarily',
            'products' => $products 
        ], 200);
    }
    
    
    
    
    

    /**
     * Display temporarily stored products.
     *
     * @return \Illuminate\Http\Response
     */
    public function showTemporaryProducts()
    {
        $products = session()->get('products', []);

        return response()->json([
            'products' => $products
        ], 200);
    }

    /**
     * Update a temporary product in the session.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $index
     * @return \Illuminate\Http\Response
     */
    public function updateTemporaryProduct(Request $request, $index)
    {
        $validated = $request->validate([
            'productName' => 'required|string',
            'productQuantity' => 'required|integer',
            'productWeight' => 'required|numeric',
        ]);

        $products = session()->get('products', []);

        if (!isset($products[$index])) {
            return response()->json([
                'message' => 'Product not found'
            ], 404);
        }

        $products[$index] = $validated;

        session()->put('products', $products);

        return response()->json([
            'message' => 'Product updated successfully',
            'products' => $products
        ], 200);
    }

    /**
     * Remove a temporary product from the session.
     *
     * @param int $index
     * @return \Illuminate\Http\Response
     */
    public function deleteTemporaryProduct($index)
    {
        $products = session()->get('products', []);

        if (!isset($products[$index])) {
            return response()->json([
                'message' => 'Product not found'
            ], 404);
        }

        unset($products[$index]);

        $products = array_values($products);

        session()->put('products', $products);

        return response()->json([
            'message' => 'Product deleted successfully',
            'products' => $products
        ], 200);
    }

    /**
     * Clear temporarily stored products in the session.
     *
     * @return \Illuminate\Http\Response
     */
    public function clearTemporaryProducts()
    {

        session()->forget('products');

        return response()->json([
            'message' => 'Temporary products cleared'
        ], 200);
    }
}
