<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SampleHistory;
use App\Models\MedicalInformation;

class SampleHistoryController extends Controller
{
    public function index()
    {
        // Retrieve patient_id from session
        $patientId = session('patient_id');

        // Retrieve the latest SampleHistory record for the patient_id
        $samplehistory = SampleHistory::where('patient_id', $patientId)
            ->orderBy('created_at', 'desc')
            ->first();

        return view('samplehistory', compact('samplehistory'));
    }


    public function store(Request $request)
    {
        $patientId = session('patient_id');

        // Validate the request data
        $validatedData = $request->validate([
            'signs_symptoms' => 'sometimes|nullable|string|max:255',
            'allergies' => 'sometimes|nullable|string|max:255',
            'medications' => 'sometimes|nullable|string|max:255',
            'past_medical_history' => 'sometimes|nullable|string|max:255',
            'last_oral_intake' => 'sometimes|nullable|string|max:255',
            'event_leading_to_injury' => 'sometimes|nullable|string|max:255',
        ]);

        $existingPatient = SampleHistory::where('patient_id', $patientId)->first();

        if ($existingPatient) {
            return $this->updateSample($request, $patientId);
        }

        $validatedData['patient_id'] = $patientId;

        // Create a new sample history record
        $samplehistory = new SampleHistory;
        $samplehistory->patient_id = $validatedData['patient_id'] ?? null;
        $samplehistory->signs_symptoms = $validatedData['signs_symptoms'] ?? null;
        $samplehistory->allergies = $validatedData['allergies'] ?? null;
        $samplehistory->medications = $validatedData['medications'] ?? null;
        $samplehistory->past_medical_history = $validatedData['past_medical_history'] ?? null;
        $samplehistory->last_oral_intake = $validatedData['last_oral_intake'] ?? null;
        $samplehistory->event_leading_to_injury = $validatedData['event_leading_to_injury'] ?? null;
        $samplehistory->save();

        // Redirect back with a success message
        return view('vitalsigns')->with('success', 'Sample history saved successfully.');
    }

    private function updateSample(Request $request, $patientId)
    {
        $samplehistory = SampleHistory::findOrFail($patientId);
        $samplehistory->fill($request->all());
        $samplehistory->save();

        return redirect()->back()->with('success', 'Sample history saved successfully.');
    }


}
