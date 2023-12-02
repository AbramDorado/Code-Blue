<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient; 
use App\Models\CodeBlueActivation;  


class MainInformationController extends Controller
{
    function index($code_number)
    {   
        $codeBlueActivation = CodeBlueActivation::where('code_number', $code_number)->first();

        $patient = null;
        if ($codeBlueActivation) {
            $patient = Patient::where('patient_pin', $codeBlueActivation->patient_pin)->first();
        }

        return view('maininformation', compact('code_number', 'codeBlueActivation', 'patient'));
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

        return view('initialresuscitation', ['code_number' => $code_number]);
    }

}
