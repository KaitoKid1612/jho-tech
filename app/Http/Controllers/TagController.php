<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Tag::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:tags',
            'color' => 'nullable|string',
        ]);

        $tag = Tag::create($request->all());

        return response()->json($tag, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        return response()->json($tag);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {
        $tag->update($request->all());

        return response()->json($tag);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();
        return response()->json(null, 204);
    }

    public function assign(Request $request)
    {
        $model = app($request->model_type)::findOrFail($request->model_id);
        $tag = Tag::findOrFail($request->tag_id);

        $model->tags()->attach($tag->id);

        return response()->json(['message' => 'Tag assigned successfully']);
    }
}
