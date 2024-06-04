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
    // Validação dos dados de entrada
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255',
        'profession' => 'nullable|string|max:255',
        'marital_status' => 'nullable|string|max:255',
        'spouse_name' => 'nullable|string|max:255',
        'spouse_age' => 'nullable|integer',
        'spouse_profession' => 'nullable|string|max:255',
        'spouse_education' => 'nullable|string|max:255',
        'main_complaint' => 'nullable|string',
        'previous_therapy' => 'nullable|string',
        'patient_expectations' => 'nullable|string',
        'presented_symptoms' => 'nullable|string',
        'physical_diseases' => 'nullable|string',
        'psychosocial_stressors' => 'nullable|string',
        'global_functioning' => 'nullable|string',
        'psychological_conceptualization' => 'nullable|string',
        'previous_psychiatric_disorders' => 'nullable|string',
        'family_psychiatric_disorders' => 'nullable|string',
        'significant_diseases' => 'nullable|string',
        'current_medication' => 'nullable|string',
        'alternative_medication' => 'nullable|string',
        'test_application' => 'nullable|string',
        'complaint_start' => 'nullable|string',
        'traumatic_events' => 'nullable|string',
        'crisis_factors' => 'nullable|string',
        'drug_use' => 'nullable|string',
        'suicide_attempt' => 'nullable|string',
        'therapeutic_focus' => 'nullable|string',
        'pregnancy' => 'nullable|string',
        'childbirth' => 'nullable|string',
        'breastfeeding' => 'nullable|string',
        'hygiene_training' => 'nullable|string',
        'childhood_stressors' => 'nullable|string',
        'childhood_disorders' => 'nullable|string',
        'other_comments' => 'nullable|string',
        'affectionate_experiences' => 'nullable|string',
        'sexual_experiences' => 'nullable|string',
        'first_jobs' => 'nullable|string',
        'friendship_circles' => 'nullable|string',
        'partner_relationships' => 'nullable|string',
        'current_sex_life' => 'nullable|string',
        'financial_situation' => 'nullable|string',
        'abortions' => 'nullable|string',
        'social_support' => 'nullable|string',
        'current_disorders' => 'nullable|string',
        'main_leisure_activities' => 'nullable|string',
        'social_life' => 'nullable|string',
        'general_observation' => 'nullable|string',
        'non_verbal_language' => 'nullable|string',
        'professional' => 'nullable|string|max:255',
        'referrals_made' => 'nullable|string',
        'therapeutics_used' => 'nullable|string'
    ]);
    

    // Criação do registro no banco de dados
    $patientRecord = PatientRecord::create($validatedData);

    // Resposta de sucesso
    return response()->json([
        'message' => 'Record successfully created!',
        'data' => $patientRecord
    ], 201);
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
