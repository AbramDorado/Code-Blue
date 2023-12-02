<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CodeBlueActivation;

class CodeBlueActivationController extends Controller
{
    public function storeOrUpdate(Request $request, $code_number)
    {
        $patientPin = $request->input('patient_pin');
        $validatedData2 = $request->validate([
            'code_start_dt' => 'sometimes|nullable|date',
            'arrest_dt' => 'sometimes|nullable|date',
            'reason_for_activation' => 'sometimes|nullable|in:unconscious,pulseless',
            'initial_reporter' => 'sometimes|nullable|string',
            'code_team_arrival_dt' => 'sometimes|nullable|date',
            'e_cart_arrival_dt' => 'sometimes|nullable|date',
            'witnessed' => 'sometimes|nullable|in:yes,no',  
            'patient_pin' => 'sometimes|nullable|integer',
        ]);
        
        $validatedData2['patient_pin'] = $patientPin;
        
        $existingCodeBlueActivation = CodeBlueActivation::where('code_number', $code_number)->first();

        if ($existingCodeBlueActivation) {
            return $this->updateCodeBlueActivation($request, $code_number);
        }

        $codeBlueActivation = new CodeBlueActivation;

        $codeBlueActivation->code_start_dt = $validatedData2['code_start_dt'] ?? null;
        $codeBlueActivation->arrest_dt = $validatedData2['arrest_dt'];
        $codeBlueActivation->reason_for_activation = $validatedData2['reason_for_activation'] ?? null;
        $codeBlueActivation->initial_reporter = $validatedData2['initial_reporter'] ?? null;
        $codeBlueActivation->code_team_arrival_dt = $validatedData2['code_team_arrival_dt'] ?? null;
        $codeBlueActivation->e_cart_arrival_dt = $validatedData2['e_cart_arrival_dt'] ?? null;
        $codeBlueActivation->witnessed = $validatedData2['witnessed'] ?? null;
        $codeBlueActivation->patient_pin = $validatedData2['patient_pin'] ?? null;
        $codeBlueActivation->code_number = $code_number; // Add this line to set the code_number

        $codeBlueActivation->save();

        return view('initialresuscitation', ['code_number' => $code_number]);
    }

    private function updateCodeBlueActivation(Request $request, $code_number)
    {
        $codeBlueActivation = CodeBlueActivation::findOrFail($code_number);
        $codeBlueActivation->fill($request->all());
        $codeBlueActivation->save();

        return view('initialresuscitation', ['code_number' => $code_number]);
    }
}
