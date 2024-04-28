<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HTAssessment;

class HTAssessmentController extends Controller
{
    public function index()
    {
        // Retrieve patient_id from session
        $patientId = session('patient_id');

        // Retrieve the latest SampleHistory record for the patient_id
        $htassessment = HTAssessment::where('patient_id', $patientId)
            ->orderBy('created_at', 'desc')
            ->first();

        return view('htassessment', compact('htassessment'));
    }


    public function store(Request $request)
    {
        $patientId = session('patient_id');

        // Validate the request data
        $validatedData = $request->validate([
            'head' => 'sometimes|nullable|string|max:255',
            'shoulders' => 'sometimes|nullable|string|max:255',
            'arms' => 'sometimes|nullable|string|max:255',
            'body' => 'sometimes|nullable|string|max:255',
            'legs' => 'sometimes|nullable|string|max:255',
            'toes' => 'sometimes|nullable|string|max:255',            
        ]);

        $validatedData['patient_id'] = $patientId;

        // Create a new sample history record
        $htassessment = new HTAssessment;
        $htassessment->patient_id = $validatedData['patient_id'] ?? null;
        $htassessment->head = $validatedData['head'] ?? null;
        $htassessment->shoulders = $validatedData['shoulders'] ?? null;
        $htassessment->arms = $validatedData['arms'] ?? null;
        $htassessment->body = $validatedData['body'] ?? null;
        $htassessment->legs = $validatedData['legs'] ?? null;
        $htassessment->toes = $validatedData['toes'] ?? null;
        $htassessment->save();

        // Redirect back with a success message
        return view('rmfinformation')->with('success', ' Head to Toe Assessment saved successfully.');
    }
}
