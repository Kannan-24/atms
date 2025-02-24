<?php

namespace App\Http\Controllers;

use App\Models\Batches;
use Illuminate\Http\Request;

class BatchesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $batches = Batches::paginate(9);
        return view('batches.index', compact('batches'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('batches.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'start_year' => 'required|date_format:Y',
            'end_year' => 'required|date_format:Y',
        ]);

        Batches::create($request->all());

        return redirect()->route('batches.index')
            ->with('success', 'Batch created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Batches $batch)
    {
        
        return view('batches.show', compact('batch'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Batches $batch)
    {
        return view('batches.edit', compact('batch'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Batches $batch)
    {
        $request->validate([
            'start_year' => 'required|date_format:Y',
            'end_year' => 'required|date_format:Y',
        ]);

        $batch->update($request->all());

        return redirect()->route('batches.index')
            ->with('success', 'Batch updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Batches $batches)
    {
        $batches->delete();

        return redirect()->route('batches.index')
            ->with('success', 'Batch deleted successfully.');
    }
}
