<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient; 
use App\Models\CodeBlueActivation;
use App\Models\User;  


class MainInformationController extends Controller
{   
    function index($code_number)
    {
        $usersController = new UserController();
        $users = $usersController->getNames();

        // Fetch CodeBlueActivation based on the provided $code_number
        $codeBlueActivation = CodeBlueActivation::where('code_number', $code_number)->first();

        // Check if $codeBlueActivation exists before querying the Patient
        $patient = null;
        if ($codeBlueActivation) {
            $patient = Patient::where('patient_pin', $codeBlueActivation->patient_pin)->first();
        }

        // Return the view with necessary data
        return view('maininformation', compact('code_number', 'users', 'codeBlueActivation', 'patient'));
    }

    
    public function store(Request $request, $code_number)
    {
        $patientController = new PatientController;
        $codeBlueActivationController = new CodeBlueActivationController;
    
        // Validate and store/update patient information
        $patient_pin = $request->input('patient_pin');
        $patientController->storeOrUpdate($request, $patient_pin, $code_number);
    
        // Validate and store/update code blue activation information
        $codeBlueActivationController->storeOrUpdate($request, $code_number);
    
        // Check if the selected initial reporter is "other"
        $initialReporter = $request->input('initial_reporter');
        if ($initialReporter === 'other') {
            // Use the value from the manual input field
            $initialReporter = $request->input('other_reporter');
        }
    
        // Update your database with $initialReporter
        // For example, if you have a CodeBlueActivation model, you might do:
        $codeBlueActivation = CodeBlueActivation::where('code_number', $code_number)->first();
        if ($codeBlueActivation) {
            $codeBlueActivation->initial_reporter = $initialReporter;
            $codeBlueActivation->save();
        }
    
        return view('initialresuscitation', ['code_number' => $code_number]);
    }
    
    
}
