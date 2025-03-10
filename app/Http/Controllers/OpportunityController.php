<?php

namespace App\Http\Controllers;

use App\Models\Opportunity;
use Illuminate\Http\Request;

class OpportunityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Opportunity::with('tags')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'status' => 'required|in:new,in_progress,won,lost',
            'amount' => 'nullable|numeric',
            'contact_id' => 'required|exists:contacts,id',
        ]);

        $opportunity = Opportunity::create($request->all());

        return response()->json($opportunity, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Opportunity $opportunity)
    {
        return response()->json($opportunity->load('tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Opportunity $opportunity)
    {
        $opportunity->update($request->all());

        return response()->json($opportunity);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Opportunity $opportunity)
    {
        $opportunity->delete();
        return response()->json(null, 204);
    }
}
