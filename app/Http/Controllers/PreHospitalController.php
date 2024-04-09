<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MedicalInformation; // Import the MedicalInformation model

class PreHospitalController extends Controller
{
    public function index()
    {
        // Retrieve the latest medical information
        $medicalInfo = MedicalInformation::latest()->first();

        // If medical information is found, get the associated patient_id
        if ($medicalInfo) {
            $patientId = $medicalInfo->patient_id;

            // You can then use $patientId as needed, for example, to fetch the patient details
            $patient = MedicalInformation::find($patientId);

            return view('prehospital', compact('patient'));
        }

        // If no medical information is found, return the view without patient details
        return view('prehospital');
    }


    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'full_name' => 'sometimes|nullable|string|max:255',
            'contact_num_p' => 'sometimes|nullable|string|max:255',
            'address_p' => 'sometimes|nullable|string|max:255',
            'sex' => 'sometimes|nullable|string|max:10',
            'age' => 'sometimes|nullable|integer',
            'status' => 'sometimes|nullable|string|max:255',
            'blood_type' => 'sometimes|nullable|string|max:10',
            'comps_name' => 'sometimes|nullable|string|max:255',
            'relationship' => 'sometimes|nullable|string|max:255',
            'address_c' => 'sometimes|nullable|string|max:255',
            'contact_num_c' => 'sometimes|nullable|string|max:255',
            'team' => 'sometimes|nullable|string|max:255',
            'plate_num' => 'sometimes|nullable|string|max:255',
            'driver' => 'sometimes|nullable|string|max:255',
            'reporter' => 'sometimes|nullable|string|max:255',
            'cameraman' => 'sometimes|nullable|string|max:255',
            'team_leader' => 'sometimes|nullable|string|max:255',
            'crew1' => 'sometimes|nullable|string|max:255',
            'crew2' => 'sometimes|nullable|string|max:255',
            'crew3' => 'sometimes|nullable|string|max:255',
            'crew4' => 'sometimes|nullable|string|max:255',
            'departure_base_time' => 'sometimes|nullable|string|max:255',
            'arrival_scene_time' => 'sometimes|nullable|string|max:255',
            'arrival_hospital_time' => 'sometimes|nullable|string|max:255',
            'departure_hospital_time' => 'sometimes|nullable|string|max:255',
            'arrival_base_time' => 'sometimes|nullable|string|max:255',
            'incident_dt' => 'sometimes|nullable|date',
            'location' => 'sometimes|nullable|string|max:255',
            'remarks' => 'sometimes|nullable|string|max:255',
        ]);

        // Create a new instance of the MedicalInformation model and fill it with the validated data
        $medicalInformation = new MedicalInformation();
        $medicalInformation->full_name = $validatedData['full_name'] ?? null;
        $medicalInformation->contact_num_p = $validatedData['contact_num_p'] ?? null;
        $medicalInformation->address_p = $validatedData['address_p'] ?? null;
        $medicalInformation->sex = $validatedData['sex'] ?? null;
        $medicalInformation->age = $validatedData['age'] ?? null;
        $medicalInformation->status = $validatedData['status'] ?? null;
        $medicalInformation->blood_type = $validatedData['blood_type'] ?? null;
        $medicalInformation->comps_name = $validatedData['comps_name'] ?? null;
        $medicalInformation->relationship = $validatedData['relationship'] ?? null;
        $medicalInformation->address_c = $validatedData['address_c'] ?? null;
        $medicalInformation->contact_num_c = $validatedData['contact_num_c'] ?? null;
        $medicalInformation->team = $validatedData['team'] ?? null;
        $medicalInformation->plate_num = $validatedData['plate_num'] ?? null;
        $medicalInformation->driver = $validatedData['driver'] ?? null;
        $medicalInformation->reporter = $validatedData['reporter'] ?? null;
        $medicalInformation->cameraman = $validatedData['cameraman'] ?? null;
        $medicalInformation->team_leader = $validatedData['team_leader'] ?? null;
        $medicalInformation->crew1 = $validatedData['crew1'] ?? null;
        $medicalInformation->crew2 = $validatedData['crew2'] ?? null;
        $medicalInformation->crew3 = $validatedData['crew3'] ?? null;
        $medicalInformation->crew4 = $validatedData['crew4'] ?? null;
        $medicalInformation->departure_base_time = $validatedData['departure_base_time'] ?? null;
        $medicalInformation->arrival_scene_time = $validatedData['arrival_scene_time'] ?? null;
        $medicalInformation->arrival_hospital_time = $validatedData['arrival_hospital_time'] ?? null;
        $medicalInformation->departure_hospital_time = $validatedData['departure_hospital_time'] ?? null;
        $medicalInformation->arrival_base_time = $validatedData['arrival_base_time'] ?? null;
        $medicalInformation->incident_dt = $validatedData['incident_dt'] ?? null;
        $medicalInformation->location = $validatedData['location'] ?? null;
        $medicalInformation->remarks = $validatedData['remarks'] ?? null;

        // Save the medical information to the database
        $medicalInformation->save();
        session(['patient_id' => $medicalInformation->patient_id]);

        // Redirect the user back to the previous page or wherever you want
        return redirect()->back()->with('success', 'Medical information saved successfully.');
    }

    // public function store(Request $request)
    // {
    //     $patientController = new PCRPatientController;
    //     // $codeBlueActivationController = new CodeBlueActivationController;
    
    //     // Validate and store/update patient information
    //     // $patient_pin = $request->input('patient_pin');
    //     $patientController->storeOrUpdate($request);
    
    //     // Validate and store/update code blue activation information
    //     // $codeBlueActivationController->storeOrUpdate($request, $code_number);
    
    //     // // Check if the selected initial reporter is "other"
    //     // $initialReporter = $request->input('initial_reporter');
    //     // if ($initialReporter === 'other') {
    //     //     // Use the value from the manual input field
    //     //     $initialReporter = $request->input('other_reporter');
    //     // }
    
    //     // // Update your database with $initialReporter
    //     // // For example, if you have a CodeBlueActivation model, you might do:
    //     // $codeBlueActivation = CodeBlueActivation::where('code_number', $code_number)->first();
    //     // if ($codeBlueActivation) {
    //     //     $codeBlueActivation->initial_reporter = $initialReporter;
    //     //     $codeBlueActivation->save();
    //     // }
    
    //     return redirect()->back()->with('success', 'Medical information saved successfully.');
    // }
}
