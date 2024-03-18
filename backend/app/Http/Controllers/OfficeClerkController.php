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
        OfficeClerk::create([
            "name" => $request->name,
            "email" => $request->email,
            "description" => $request->description,
        ]);
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
        OfficeClerk::where("id", $id)->update([
            "name" => $request->name,
            "email" => $request->email,
            "description" => $request->description,
        ]);
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
