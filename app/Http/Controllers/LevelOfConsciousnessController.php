<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LevelOfConsciousness;

class LevelOfConsciousnessController extends Controller
{
    public function index()
    {
        // Retrieve patient_id from session
        $patientId = session('patient_id');

        // Retrieve the latest SampleHistory record for the patient_id
        $levelofconsciousness = LevelOfConsciousness::where('patient_id', $patientId)
            ->orderBy('created_at', 'desc')
            ->first();

        return view('levelofconsciousness', compact('levelofconsciousness'));
    }


    public function store(Request $request)
    {
        $patientId = session('patient_id');

        // Validate the request data
        $validatedData = $request->validate([
            'loc_baseline_time' => 'sometimes|nullable|string|max:255',
            'status_baseline' => 'sometimes|nullable|string|max:255',
            'loc_2nd_time' => 'sometimes|nullable|string|string|max:255',
            'status2' => 'sometimes|nullable|string|max:255',
            'loc_3rd_time' => 'sometimes|nullable|string|max:255',
            'status3' => 'sometimes|nullable|string|max:255',
            'loc_4th_time' => 'sometimes|nullable|string|max:255',
            'status4' => 'sometimes|nullable|string|max:255',
            
        ]);

        $validatedData['patient_id'] = $patientId;

        // Create a new level of consciousness record
        $levelofconsciousness = new LevelOfConsciousness;
        $levelofconsciousness->patient_id = $validatedData['patient_id'] ?? null;
        $levelofconsciousness->loc_baseline_time = $validatedData['loc_baseline_time'] ?? null;
        $levelofconsciousness->status_baseline = $validatedData['status_baseline'] ?? null;
        $levelofconsciousness->loc_2nd_time = $validatedData['loc_2nd_time'] ?? null;
        $levelofconsciousness->status2 = $validatedData['status2'] ?? null;
        $levelofconsciousness->loc_3rd_time = $validatedData['loc_3rd_time'] ?? null;
        $levelofconsciousness->status3 = $validatedData['status3'] ?? null;
        $levelofconsciousness->loc_4th_time = $validatedData['loc_4th_time'] ?? null;
        $levelofconsciousness->status4 = $validatedData['status4'] ?? null;
        
        $levelofconsciousness->save();

        // Redirect back with a success message
        return view('samplehistory')->with('success', 'level of consciousness saved successfully.');
    }

}
