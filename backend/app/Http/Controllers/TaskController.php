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
        return Task::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $taskData = $request->validate([
            'office_clerk_id' => 'required|exists:office_clerks,id',
            'description' => 'required|string',
        ]);

        Task::create($taskData);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Task::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $taskData = $request->validate([
            'office_clerk_id' => 'required|exists:office_clerks,id',
            'description' => 'required|string',
        ]);

        Task::where("id", $id)->update($taskData);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Task::where("id", $id)->delete();
    }
}
