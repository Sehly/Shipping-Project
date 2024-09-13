<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Order;

use App\Models\Branch;

use App\Models\Region;

use App\Models\User;

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
        $orders = Order::with(['branch', 'region', 'user'])->get();
        return response()->json([
            'data' => OrderResource::collection($orders),
            'message' => 'orders retrieved successfully',
        ], 200);
        // return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new order.
     *
     * @return \Illuminate\Http\Response
     */


    // public function create()
    // {
    //     $branches = Branch::all();
    //     $regions = Region::all();
    //     $users = User::all();
    //     return view('orders.create', compact('branches', 'regions', 'users'));
    // }

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
            'weight' => 'required|numeric',
            'created_date' => 'required|date',
            'branch_id' => 'required|exists:branches,id',
            'region_id' => 'required|exists:regions,id',
            'user_id' => 'required|exists:users,id',
        ]);
        $max_weight=15;
        $weight =  $request->weight ;
        $cost=45;
        if($weight > $max_weight){
            $cost = ( ($weight - $max_weight) * 5 ) + $cost ;
        }

        $order = Order::create([
            'status' => $request->status,
            'weight' => $request->weight,
            'created_date' => $request->created_date,
            'cost' => $cost,
            'max_weight' => $max_weight,
            'branch_id' => $request->branch_id,
            'region_id' => $request->region_id,
            'user_id' => $request->user_id,
        ]);
 

        return response()->json([
            'success' => true,
            'data' => new OrderResource($order),
            'message' => 'Order created successfully',
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
        return response()->json(new OrderResource($order), 200);
    }

    /**
     * Show the form for editing the specified order.
     *
     * @param \App\Models\Order $order
     * @return \Illuminate\Http\Response
     */


    // public function edit(Order $order)
    // {
    //     $branches = Branch::all();
    //     $regions = Region::all();
    //     $users = User::all();
    //     return view('orders.edit', compact('order', 'branches', 'regions', 'users'));
    // }

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
            'weight' => 'required|numeric',
            'created_date' => 'required|date',
            'branch_id' => 'required|exists:branches,id',
            'region_id' => 'required|exists:regions,id',
            'user_id' => 'required|exists:users,id',
        ]);

        $order->update($request->all());

        return response()->json([
            'success' => true,
            'data' => new OrderResource($order),
            'message' => 'Order updated successfully',
        ], 200);
        // return redirect()->route('orders.index')
        //     ->with('success', 'Order updated successfully.');
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
        // return redirect()->route('orders.index')
        //     ->with('success', 'Order deleted successfully.');
    }
}
