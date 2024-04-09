<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PCRPatient;

class PCRPatientController extends Controller
{
    public function storeOrUpdate(Request $request)
    {
        $validatedData = $request->validate([
            'full_name' => 'sometimes|nullable|max:255',
            'contact_num_p' => 'required|string|max:255',
            'address_p' => 'required|string|max:255',
            'sex' => 'required|string|max:10',
            'age' => 'required|integer',
            'status' => 'required|string|max:255',
            'blood_type' => 'required|string|max:10',
            'comps_name' => 'required|string|max:255',
            'relationship' => 'required|string|max:255',
            'address_c' => 'required|string|max:255',
            'contact_num_c' => 'required|string|max:255',
        ]);

        // $existingPatient = PCRPatient::where('patient_pin', $patient_pin)->first();

        // if ($existingPatient) {
        //     return $this->updatePatient($request, $patient_pin, $code_number);
        // }

        $patient = new PCRPatient;
        
        $patient->full_name = $validatedData['full_name'] ?? null;
        $patient->contact_num_p = $validatedData['contact_num_p'] ?? null;
        $patient->address_p = $validatedData['address_p'] ?? null;
        $patient->sex = $validatedData['sex'] ?? null;
        $patient->age = $validatedData['age'] ?? null;
        $patient->status = $validatedData['status'] ?? null;
        $patient->blood_type = $validatedData['blood_type'] ?? null;
        $patient->comps_name = $validatedData['comps_name'] ?? null;
        $patient->relationship = $validatedData['relationship'] ?? null;
        $patient->address_c = $validatedData['address_c'] ?? null;
        $patient->contact_num_c = $validatedData['contact_num_c'] ?? null;
        $patient->save();

        return redirect()->back()->with('success', 'Medical information saved successfully.');
    }

    // private function updatePatient(Request $request, $patient_pin, $code_number)
    // {
    //     $patient = Patient::findOrFail($patient_pin);
    //     $patient->fill($request->all());
    //     $patient->save();

    //     return view('initialresuscitation', ['code_number' => $code_number]);
    // }

    public function searchPatientPins(Request $request)
    {
        $input = $request->input('query');

        $patientPins = PCRPatient::where('patient_pin', 'LIKE', $input . '%')->pluck('patient_pin');

        return response()->json($patientPins);
    }


    public function fetchPatientInformation(Request $request)
    {
        $patientPin = $request->input('patient_pin');

        // Your logic to fetch patient information from the database based on $patientPin
        $patientInformation = PCRPatient::where('patient_pin', $patientPin)->first();

        if ($patientInformation) {
            // If patient information is found, return it as JSON response
            return response()->json($patientInformation);
        } else {
            // If patient is not found, return an error response
            return response()->json(['error' => 'Patient not found'], 404);
        }
    }
}
