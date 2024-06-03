<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PatientRecord;

class PatientRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $records = PatientRecord::all();
        return response()->json($records);
    }
    public function index_user($email) 
    {
        $records = PatientRecord::where("email", $email)->get();
        return response()->json($records);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
