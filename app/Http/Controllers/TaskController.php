<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::with(['opportunity', 'contact', 'user', 'tags'])
            ->orderBy('created_at', 'desc')
            ->paginate(25);

        return response()->json($tasks);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'status' => 'required|in:pending,in_progress,completed',
            'due_date' => 'nullable|date',
            'contact_id' => 'nullable|exists:contacts,id',
            'opportunity_id' => 'nullable|exists:opportunities,id',
        ]);

        $task = Task::create($request->all());

        return response()->json($task, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return response()->json($task->load('tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $task->update($request->all());

        return response()->json($task);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json(null, 204);
    }

    public function filter(Request $request)
    {
        $query = Task::query();

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        if ($request->has('created_by')) {
            $query->where('created_by', $request->created_by);
        }

        if ($request->has('manager')) {
            $query->where('manager', $request->manager);
        }

        return response()->json($query->paginate(10));
    }
}
