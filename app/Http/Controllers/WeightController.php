<?php

namespace App\Http\Controllers;

use App\Models\Weight;
use Illuminate\Http\Request;

class WeightController extends Controller
{
    /**
     * Display a listing of the weights.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $weights = Weight::all();
        return view('weights.index', compact('weights'));
    }

    /**
     * Show the form for creating a new weight.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('weights.create');
    }

    /**
     * Store a newly created weight in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'max_weight' => 'required|numeric',
            'cost_per_unit' => 'required|numeric',
        ]);

        Weight::create($request->all());

        return redirect()->route('weights.index')
            ->with('success', 'Weight created successfully.');
    }

    /**
     * Display the specified weight.
     *
     * @param \App\Models\Weight $weight
     * @return \Illuminate\Http\Response
     */
    public function show(Weight $weight)
    {
        return view('weights.show', compact('weight'));
    }

    /**
     * Show the form for editing the specified weight.
     *
     * @param \App\Models\Weight $weight
     * @return \Illuminate\Http\Response
     */
    public function edit(Weight $weight)
    {
        return view('weights.edit', compact('weight'));
    }

    /**
     * Update the specified weight in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Weight $weight
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Weight $weight)
    {
        $request->validate([
            'max_weight' => 'required|numeric',
            'cost_per_unit' => 'required|numeric',
        ]);

        $weight->update($request->all());

        return redirect()->route('weights.index')
            ->with('success', 'Weight updated successfully.');
    }

    /**
     * Remove the specified weight from storage.
     *
     * @param \App\Models\Weight $weight
     * @return \Illuminate\Http\Response
     */
    public function destroy(Weight $weight)
    {
        $weight->delete();

        return redirect()->route('weights.index')
            ->with('success', 'Weight deleted successfully.');
    }
}
