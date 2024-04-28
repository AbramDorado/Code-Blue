<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VitalSigns;

class VitalSignsController extends Controller
{
    public function index()
    {
        // Retrieve patient_id from session
        $patientId = session('patient_id');

        // Retrieve the latest SampleHistory record for the patient_id
        $vitalsigns = VitalSigns::where('patient_id', $patientId)
            ->orderBy('created_at', 'desc')
            ->first();

        return view('vitalsigns', compact('vitalsigns'));
    }


    public function store(Request $request)
    {
        $patientId = session('patient_id');

        // Validate the request data
        $validatedData = $request->validate([
            'vs_1st_time' => 'sometimes|nullable|string|max:255',
            'blood_pressure1' => 'sometimes|nullable|string|max:255',
            'respiratory_rate1' => 'sometimes|nullable|numeric',
            'pulse_rate1' => 'sometimes|nullable|numeric',
            'oxygen_sat1' => 'sometimes|nullable|numeric',
            'skin_color1' => 'sometimes|nullable|string|max:255',
            'skin_temp1' => 'sometimes|nullable|string|max:255',
            'vs_2nd_time' => 'sometimes|nullable|string|max:255',
            'blood_pressure2' => 'sometimes|nullable|string|max:255',
            'respiratory_rate2' => 'sometimes|nullable|numeric',
            'pulse_rate2' => 'sometimes|nullable|numeric',
            'oxygen_sat2' => 'sometimes|nullable|numeric',
            'skin_color2' => 'sometimes|nullable|string|max:255',
            'skin_temp2' => 'sometimes|nullable|string|max:255',
            'vs_3rd_time' => 'sometimes|nullable|string|max:255',
            'blood_pressure3' => 'sometimes|nullable|string|max:255',
            'respiratory_rate3' => 'sometimes|nullable|numeric',
            'pulse_rate3' => 'sometimes|nullable|numeric',
            'oxygen_sat3' => 'sometimes|nullable|numeric',
            'skin_color3' => 'sometimes|nullable|string|max:255',
            'skin_temp3' => 'sometimes|nullable|string|max:255',
            'vs_4th_time' => 'sometimes|nullable|string|max:255',
            'blood_pressure4' => 'sometimes|nullable|string|max:255',
            'respiratory_rate4' => 'sometimes|nullable|numeric',
            'pulse_rate4' => 'sometimes|nullable|numeric',
            'oxygen_sat4' => 'sometimes|nullable|numeric',
            'skin_color4' => 'sometimes|nullable|string|max:255',
            'skin_temp4' => 'sometimes|nullable|string|max:255',
            
        ]);

        $validatedData['patient_id'] = $patientId;

        // Create a new sample history record
        $vitalsigns = new VitalSigns;
        $vitalsigns->patient_id = $validatedData['patient_id'] ?? null;
        $vitalsigns->vs_1st_time = $validatedData['vs_1st_time'] ?? null;
        $vitalsigns->blood_pressure1 = $validatedData['blood_pressure1'] ?? null;
        $vitalsigns->respiratory_rate1 = $validatedData['respiratory_rate1'] ?? null;
        $vitalsigns->pulse_rate1 = $validatedData['pulse_rate1'] ?? null;
        $vitalsigns->oxygen_sat1 = $validatedData['oxygen_sat1'] ?? null;
        $vitalsigns->skin_color1 = $validatedData['skin_color1'] ?? null;
        $vitalsigns->skin_temp1 = $validatedData['skin_temp1'] ?? null;
        $vitalsigns->vs_2nd_time = $validatedData['vs_2nd_time'] ?? null;
        $vitalsigns->blood_pressure2 = $validatedData['blood_pressure2'] ?? null;
        $vitalsigns->respiratory_rate2 = $validatedData['respiratory_rate2'] ?? null;
        $vitalsigns->pulse_rate2 = $validatedData['pulse_rate2'] ?? null;
        $vitalsigns->oxygen_sat2 = $validatedData['oxygen_sat2'] ?? null;
        $vitalsigns->skin_color2 = $validatedData['skin_color2'] ?? null;
        $vitalsigns->skin_temp2 = $validatedData['skin_temp2'] ?? null;
        $vitalsigns->vs_3rd_time = $validatedData['vs_3rd_time'] ?? null;
        $vitalsigns->blood_pressure3 = $validatedData['blood_pressure3'] ?? null;
        $vitalsigns->respiratory_rate3 = $validatedData['respiratory_rate3'] ?? null;
        $vitalsigns->pulse_rate3 = $validatedData['pulse_rate3'] ?? null;
        $vitalsigns->oxygen_sat3 = $validatedData['oxygen_sat3'] ?? null;
        $vitalsigns->skin_color3 = $validatedData['skin_color3'] ?? null;
        $vitalsigns->skin_temp3 = $validatedData['skin_temp3'] ?? null;
        $vitalsigns->vs_4th_time = $validatedData['vs_4th_time'] ?? null;
        $vitalsigns->blood_pressure4 = $validatedData['blood_pressure4'] ?? null;
        $vitalsigns->respiratory_rate4 = $validatedData['respiratory_rate4'] ?? null;
        $vitalsigns->pulse_rate4 = $validatedData['pulse_rate4'] ?? null;
        $vitalsigns->oxygen_sat4 = $validatedData['oxygen_sat4'] ?? null;
        $vitalsigns->skin_color4 = $validatedData['skin_color4'] ?? null;
        $vitalsigns->skin_temp4 = $validatedData['skin_temp4'] ?? null;
        $vitalsigns->save();

        // Redirect back with a success message
        return view('htassessment')->with('success', 'Vital Signs saved successfully.');
    }

}
