<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Outcome;
use App\Models\CodeBlueActivation;

class OutcomeController extends Controller
{
    private $outcome;

    public function index($code_number)
    {
        $outcome = Outcome::where('code_number', $code_number)
            ->orderBy('created_at', 'desc')
            ->first();
        // dd($outcome);
        return view('outcome', compact('code_number', 'outcome'));
    }

    public function store(Request $request, $code_number)
    {
        // Validate the incoming request data
        $request->validate([
            'outcome' => 'required', // Adjust validation rules as needed
        ]);

        $existingOutcome = Outcome::where('code_number', $code_number)->first();

        if ($existingOutcome) {
            return $this->updateOutcome($request, $existingOutcome, $code_number);
        }

        $outcome = new Outcome();
        $outcome->outcome = $request->input('outcome');

        if ($request->input('outcome') === 'Died - efforts terminated; no sustained return of circulation' || $request->input('outcome') === 'Died - with Advanced Directives/DNR in place') {
            $request->validate([
                'death_dt' => 'sometimes|nullable|date', // Validate the death date and time, nullable and sometimes
            ]);

            $outcome->death_dt = $request->input('death_dt') ?? null;
        } elseif ($request->input('outcome') === 'Survived - Return of Spontaneous Circulation') {
            $request->validate([
                'bp_systolic' => 'sometimes|nullable|integer', // Validate the blood pressure fields, nullable and sometimes
                'bp_diastolic' => 'sometimes|nullable|integer',
                'heart_rate' => 'sometimes|nullable|integer',
                'respiratory_rate' => 'sometimes|nullable|integer',
                'rhythm' => 'sometimes|nullable', // You may want to define validation rules for rhythm options
            ]);

            $outcome->bp_systolic = $request->input('bp_systolic') ?? null;
            $outcome->bp_diastolic = $request->input('bp_diastolic') ?? null;
            $outcome->heart_rate = $request->input('heart_rate') ?? null;
            $outcome->respiratory_rate = $request->input('respiratory_rate') ?? null;
            $outcome->rhythm = $request->input('rhythm') ?? null;
        }

        $outcome->code_number = $code_number;
        $outcome->save();

        return view('evaluation', ['code_number' => $code_number]);
    }

    public function updateOutcome(Request $request, Outcome $existingOutcome, $code_number)
    {
    $existingOutcome->fill($request->all());
    $existingOutcome->save();
    
    return view('evaluation', ['code_number' => $code_number]);
    }

}
