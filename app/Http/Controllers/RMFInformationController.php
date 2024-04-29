<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RMFInformation;

class RMFInformationController extends Controller
{
    public function index()
    {
        // Retrieve patient_id from session
        $patientId = session('patient_id');

        // Retrieve the latest SampleHistory record for the patient_id
        $rmfinformation = RMFInformation::where('patient_id', $patientId)
            ->orderBy('created_at', 'desc')
            ->first();

        return view('rmfinformation', compact('rmfinformation'));
    }


    public function store(Request $request)
    {
        $patientId = session('patient_id');

        // Validate the request data
        $validatedData = $request->validate([
            'hospital_name' => 'sometimes|nullable|string|max:255',
            'doctor_name' => 'sometimes|nullable|string|max:255',            
        ]);

        $validatedData['patient_id'] = $patientId;

        // Create a new sample history record
        $rmfinformation = new RMFInformation;
        $rmfinformation->patient_id = $validatedData['patient_id'] ?? null;
        $rmfinformation->hospital_name = $validatedData['hospital_name'] ?? null;
        $rmfinformation->doctor_name = $validatedData['doctor_name'] ?? null;
        $rmfinformation->save();

        // Redirect back with a success message
        // return view('includes/prehospitalcare')->with('success', ' Receiving Medical Facility Information saved successfully.');
        return redirect()->route('includes/prehospitalcare');
        // return redirect()->route('includes/codeblueforms');
    }
}
