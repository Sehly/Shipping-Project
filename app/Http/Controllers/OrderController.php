<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Branch;
use App\Models\Region;
use App\Models\User;
use App\Models\Governorate;
use App\Models\City;
use App\Models\Product;
use App\Http\Resources\OrderResource;

class OrderController extends Controller
{
    /**
     * Display a listing of the orders.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::with(['branch', 'region', 'user', 'governorate', 'city', 'products'])->get();
        return response()->json([
            'data' => OrderResource::collection($orders),
            'message' => 'Orders retrieved successfully',
        ], 200);
    }


    /**
     * Store a newly created order in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'status' => 'required|string',
            'created_date' => 'required|date',
            'branch_id' => 'required|exists:branches,id',
            'region_id' => 'required|exists:regions,id',
            'user_id' => 'required|exists:users,id',
            'city_id' => 'required|exists:cities,id', 
            'governorate_id' => 'required|exists:governorates,id', 
            'orderType' => 'nullable|in:branch,company,specific place',
            'clientName' => 'nullable|string|max:255',
            'phone1' => 'nullable|string|max:15',
            'email' => 'nullable|email|max:255',
            'village' => 'nullable|string|max:255',
            'toVillage' => 'nullable|string|max:255',
            'shippingType' => 'nullable|in:regular,in 24hours,2 weeks',
            'paymentType' => 'nullable|in:cash,visa',
            'notes' => 'nullable|string',
        ]);
        
        $products = session()->get('products');
        
        if (empty($products)) {
            return response()->json([
                'message' => 'No products found to create an order'
            ], 400);
        }

        $totalWeight = collect($products)->sum('productWeight');
        $max_weight = 15;
        $cost = 45;
        if ($totalWeight > $max_weight) {
            $cost = (($totalWeight - $max_weight) * 5) + $cost;
        }

        $order = Order::create([
            'status' => $request->status,
            'weight' => $totalWeight, 
            'created_date' => $request->created_date,
            'cost' => $cost,
            'max_weight' => $max_weight,
            'branch_id' => $request->branch_id,
            'region_id' => $request->region_id,
            'user_id' => $request->user_id,
            'city_id' => $request->city_id,
            'governorate_id' => $request->governorate_id,
            'orderType' => $request->orderType,
            'clientName' => $request->clientName,
            'phone1' => $request->phone1,
            'email' => $request->email,
            'village' => $request->village,
            'toVillage' => $request->toVillage,
            'shippingType' => $request->shippingType,
            'paymentType' => $request->paymentType,
            'notes' => $request->notes,
        ]);

        foreach ($products as $productData) {
            Product::create([
                'order_id' => $order->id,
                'productName' => $productData['productName'],
                'productQuantity' => $productData['productQuantity'],
                'productWeight' => $productData['productWeight'],
            ]);
        }
        session()->forget('products');

        return response()->json([
            'success' => true,
            'data' => new OrderResource($order->load('products')),
            'message' => 'Order and products created successfully',
        ], 201);
    }

    /**
     * Display the specified order.
     *
     * @param \App\Models\Order $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $orderWithProducts = $order->load('products');
        return response()->json(new OrderResource($orderWithProducts), 200);
    }

    /**
     * Update the specified order in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Order $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|string',
            'created_date' => 'required|date',
            'branch_id' => 'required|exists:branches,id',
            'region_id' => 'required|exists:regions,id',
            'user_id' => 'required|exists:users,id',
            'city_id' => 'required|exists:cities,id', 
            'governorate_id' => 'required|exists:governorates,id', 
            'orderType' => 'nullable|in:branch,company,specific place',
            'clientName' => 'nullable|string|max:255',
            'phone1' => 'nullable|string|max:15',
            'email' => 'nullable|email|max:255',
            'village' => 'nullable|string|max:255',
            'toVillage' => 'nullable|string|max:255',
            'shippingType' => 'nullable|in:regular,in 24hours,2 weeks',
            'paymentType' => 'nullable|in:cash,visa',
            'notes' => 'nullable|string',
        ]);

        $products = session()->get('products', []);
        $totalWeight = collect($products)->sum('productWeight');
        $max_weight = 15;
        $cost = 45;
        if ($totalWeight > $max_weight) {
            $cost = (($totalWeight - $max_weight) * 5) + $cost;
        }

        $order->update(array_merge($request->all(), [
            'weight' => $totalWeight,
            'cost' => $cost,
        ]));

        return response()->json([
            'success' => true,
            'data' => new OrderResource($order->load('products')),
            'message' => 'Order updated successfully',
        ], 200);
    }

    /**
     * Remove the specified order from storage.
     *
     * @param \App\Models\Order $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return response()->json([
            'success' => true,
            'message' => 'Order deleted successfully',
        ], 200);
    }
}

 
