<?php

namespace App\Http\Controllers;

use App\Models\OfficeClerk;
use App\Models\Task;
use GrahamCampbell\ResultType\Success;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;

class OfficeClerkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return OfficeClerk::all();
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
        $userData = $request->validate([
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|email|unique:office_clerks|max:255',
            'description' => 'required|string',
        ]);

        OfficeClerk::create($userData);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        $userData = $request->validate([
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|email|max:255|unique:office_clerks,email,' . $id,
            'description' => 'required|string',
        ]);

        OfficeClerk::where("id", $id)->update($userData);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Task::where("office_clerk_id", $id)->delete();

        OfficeClerk::where("id", $id)->delete();
    }
}
