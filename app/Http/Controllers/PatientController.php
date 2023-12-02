<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient;

class PatientController extends Controller
{
    public function storeOrUpdate(Request $request, $patient_pin, $code_number)
    {
        $validatedData = $request->validate([
            'patient_pin' => 'sometimes|nullable|integer',
            'first_name' => 'sometimes|nullable|string',
            'last_name' => 'sometimes|nullable|string',
            'middle_name' => 'sometimes|nullable|string',
            'suffix' => 'sometimes|nullable|string',
            'visit_number' => 'sometimes|nullable|integer',
            'birthday' => 'sometimes|nullable|date',
            'age' => 'sometimes|nullable|integer',
            'sex' => 'sometimes|nullable|string',
            'height' => 'sometimes|nullable|numeric',
            'weight' => 'sometimes|nullable|numeric',
            'allergies' => 'sometimes|nullable|string',
            'location' => 'sometimes|nullable|string',
        ]);

        $existingPatient = Patient::where('patient_pin', $patient_pin)->first();

        if ($existingPatient) {
            return $this->updatePatient($request, $patient_pin, $code_number);
        }

        $patient = new Patient;
        
        $patient->patient_pin = $validatedData['patient_pin'] ?? null;
        $patient->first_name = $validatedData['first_name'] ?? null;
        $patient->last_name = $validatedData['last_name'] ?? null;
        $patient->middle_name = $validatedData['middle_name'] ?? null;
        $patient->suffix = $validatedData['suffix'] ?? null;
        $patient->visit_number = $validatedData['visit_number'] ?? null;
        $patient->birthday = $validatedData['birthday'] ?? null;
        $patient->age = $validatedData['age'] ?? null;
        $patient->sex = $validatedData['sex'] ?? null;
        $patient->height = $validatedData['height'] ?? null;
        $patient->weight = $validatedData['weight'] ?? null;
        $patient->allergies = $validatedData['allergies'] ?? null;
        $patient->location = $validatedData['location'] ?? null;
        $patient->save();

        return view('initialresuscitation', ['code_number' => $code_number]);
    }

    private function updatePatient(Request $request, $patient_pin, $code_number)
    {
        $patient = Patient::findOrFail($patient_pin);
        $patient->fill($request->all());
        $patient->save();

        return view('initialresuscitation', ['code_number' => $code_number]);
    }

    public function searchPatientPins(Request $request)
    {
        $input = $request->input('query');

        $patientPins = Patient::where('patient_pin', 'LIKE', $input . '%')->pluck('patient_pin');

        return response()->json($patientPins);
    }


    public function fetchPatientInformation(Request $request)
    {
        $patientPin = $request->input('patient_pin');

        // Your logic to fetch patient information from the database based on $patientPin
        $patientInformation = Patient::where('patient_pin', $patientPin)->first();

        if ($patientInformation) {
            // If patient information is found, return it as JSON response
            return response()->json($patientInformation);
        } else {
            // If patient is not found, return an error response
            return response()->json(['error' => 'Patient not found'], 404);
        }
    }
}
