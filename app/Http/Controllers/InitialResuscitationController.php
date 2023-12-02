<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InitialResuscitation;
use App\Models\CodeBlueActivation;

class InitialResuscitationController extends Controller
{
    private $initialResuscitation;

    public function index($code_number)
    {
        $initialResuscitation = InitialResuscitation::where('code_number', $code_number)
            ->orderBy('created_at', 'desc')
            ->first();
        // dd($initialResuscitation);
        $etTubeInformation = [];
        if ($initialResuscitation !== null) {
            $etTubeInformation = json_decode($initialResuscitation->et_tube_information, true) ?? [];
        }

        return view('initialresuscitation', compact('code_number', 'initialResuscitation', 'etTubeInformation'));
    }

    public function store(Request $request, $code_number)
    {
    $validatedData = $request->validate([
        'breathing_upon_ca' => 'sometimes|nullable|string',
        'first_ventilation_dt' => 'sometimes|nullable|date',
        'ventilation' => 'sometimes|nullable|string',
        'other_ventilation' => 'sometimes|nullable|string',
        'intubation_dt' => 'sometimes|nullable|date',
        'et_tube_size' => 'sometimes|nullable|string',
        'intubation_attempts' => 'sometimes|nullable|integer',
        'et_tube_information' => 'sometimes|nullable|array',
        'et_tube_information.*' => 'sometimes|nullable|string',
        'first_documented_rhythm_dt' => 'sometimes|nullable|string',
        'first_pulseless_rhythm_dt' => 'sometimes|nullable|date',
        'compressions_dt' => 'sometimes|nullable|date',
        'aed_applied' => 'sometimes|required|in:Yes,No',
        'aed_applied_dt' => 'sometimes|nullable|date',
        'pacemaker_on' => 'sometimes|required|in:Yes,No',
        'pacemaker_on_dt' => 'sometimes|nullable|date',
    ]);

    $existingInitialResuscitation = InitialResuscitation::where('code_number', $code_number)->first();

    if ($existingInitialResuscitation) {
        return $this->updateInitialResuscitation($request, $existingInitialResuscitation, $code_number);
    }

    $initialResuscitation = new InitialResuscitation;

    $initialResuscitation->breathing_upon_ca = $validatedData['breathing_upon_ca'] ?? null;
    $initialResuscitation->first_ventilation_dt = $validatedData['first_ventilation_dt'] ?? null;
    $initialResuscitation->ventilation = $validatedData['ventilation'] ?? null;
    $initialResuscitation->other_ventilation = $validatedData['other_ventilation'] ?? null;
    $initialResuscitation->intubation_dt = $validatedData['intubation_dt'] ?? null;
    $initialResuscitation->et_tube_size = $validatedData['et_tube_size'] ?? null;
    $initialResuscitation->intubation_attempts = $validatedData['intubation_attempts'] ?? null;
    $initialResuscitation->first_documented_rhythm_dt = $validatedData['first_documented_rhythm_dt'] ?? null;
    $initialResuscitation->first_pulseless_rhythm_dt = $validatedData['first_pulseless_rhythm_dt'] ?? null;
    $initialResuscitation->compressions_dt = $validatedData['compressions_dt'] ?? null;
    $initialResuscitation->aed_applied = $validatedData['aed_applied'] ?? null;
    $initialResuscitation->aed_applied_dt = $validatedData['aed_applied_dt'] ?? null;
    $initialResuscitation->pacemaker_on = $validatedData['pacemaker_on'] ?? null;
    $initialResuscitation->pacemaker_on_dt = $validatedData['pacemaker_on_dt'] ?? null;

    $initialResuscitation->code_number = $code_number;

    // Decode et_tube_information after retrieving from the database
    $etTubeInformation = json_decode($initialResuscitation->et_tube_information, true) ?? [];

    if (!is_array($etTubeInformation)) {
        $etTubeInformation = [];
    }

    $initialResuscitation->et_tube_information = json_encode($validatedData['et_tube_information'] ?? []) ?? null;

    $initialResuscitation->save();

    return view('flowsheet', compact('code_number'));
    }

    public function updateInitialResuscitation(Request $request, InitialResuscitation $existingInitialResuscitation, $code_number)
    {
        $existingInitialResuscitation->fill($request->all());

        // Get the existing et_tube_information as an array
        $etTubeInformation = $existingInitialResuscitation->et_tube_information ?? [];
        
        // If the existing information is not an array, initialize it as an empty array
        if (!is_array($etTubeInformation)) {
            $etTubeInformation = [];
        }
        
        // Update et_tube_information with the new data
        $etTubeInformation = array_merge($etTubeInformation, $request->input('et_tube_information', []));
        
        // Save the updated et_tube_information
        $existingInitialResuscitation->et_tube_information = $etTubeInformation;
        
        // Save the changes
        $existingInitialResuscitation->save();
        
        
    
    return view('flowsheet', ['code_number' => $code_number]);
    }
}

