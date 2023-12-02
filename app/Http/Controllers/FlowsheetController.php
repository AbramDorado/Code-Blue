<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Flowsheet;

class FlowsheetController extends Controller
{

    private $flowsheet;

    public function index($code_number)
    { 
        $flowsheets = Flowsheet::where('code_number', $code_number)->get();
        // dd($flowsheets);
        return view('flowsheet', compact('code_number', 'flowsheets'));  
    }

    public function store(Request $request, $code_number)
    {
        $validatedData = $request->validate([
            'breathing' => 'sometimes|nullable|string',
            'pulse' => 'sometimes|nullable|string',
            'bp_systolic' => 'sometimes|nullable|integer',
            'bp_diastolic' => 'sometimes|nullable|integer',
            'rhythm_on_check' => 'sometimes|nullable|string',
            'rhythm_with_pulse' => 'sometimes|nullable|string',
            'rhythm_intervention' => 'sometimes|nullable|string',
            'joules' => 'sometimes|nullable|integer',
            'epinephrine_dose' => 'sometimes|nullable|numeric',
            'epinephrine_route' => 'sometimes|nullable|string',
            'amiodarone_dose' => 'sometimes|nullable|numeric',
            'amiodarone_route' => 'sometimes|nullable|string',
            'lidocaine_dose' => 'sometimes|nullable|numeric',
            'lidocaine_route' => 'sometimes|nullable|string',
            'free1_label' => 'sometimes|nullable|string',
            'free1_dose' => 'sometimes|nullable|numeric',
            'free1_route' => 'sometimes|nullable|string',
            'free2_label' => 'sometimes|nullable|string',
            'free2_dose' => 'sometimes|nullable|numeric',
            'free2_route' => 'sometimes|nullable|string',
            'comments' => 'sometimes|nullable|string',
        ]);
        
        
        $flowsheet = new Flowsheet;
        
        $flowsheet->breathing = $validatedData['breathing'] ?? null;
        $flowsheet->pulse = $validatedData['pulse'] ?? null;
        $flowsheet->bp_systolic = $validatedData['bp_systolic'] ?? null;
        $flowsheet->bp_diastolic = $validatedData['bp_diastolic'] ?? null;
        $flowsheet->rhythm_on_check = $validatedData['rhythm_on_check'] ?? null;
        $flowsheet->rhythm_with_pulse = $validatedData['rhythm_with_pulse'] ?? null;
        $flowsheet->rhythm_intervention = $validatedData['rhythm_intervention'] ?? null;
        $flowsheet->joules = $validatedData['joules'] ?? null;
        $flowsheet->epinephrine_dose = $validatedData['epinephrine_dose'] ?? null;
        $flowsheet->epinephrine_route = $validatedData['epinephrine_route'] ?? null;
        $flowsheet->amiodarone_dose = $validatedData['amiodarone_dose'] ?? null;
        $flowsheet->amiodarone_route = $validatedData['amiodarone_route'] ?? null;
        $flowsheet->lidocaine_dose = $validatedData['lidocaine_dose'] ?? null;
        $flowsheet->lidocaine_route = $validatedData['lidocaine_route'] ?? null;
        $flowsheet->free1_label = $validatedData['free1_label'] ?? null;
        $flowsheet->free1_dose = $validatedData['free1_dose'] ?? null;
        $flowsheet->free1_route = $validatedData['free1_route'] ?? null;
        $flowsheet->free2_label = $validatedData['free2_label'] ?? null;
        $flowsheet->free2_dose = $validatedData['free2_dose'] ?? null;
        $flowsheet->free2_route = $validatedData['free2_route'] ?? null;
        $flowsheet->comments = $validatedData['comments'] ?? null;
        $flowsheet->code_number =  $code_number;

        $time = $request->input('time');
        $carbonTime = Carbon::parse($time);
        $flowsheet->log_time = $carbonTime;
        $flowsheet->save();

        return view('flowsheet', compact('code_number'));
    } 

    public function fetchFlowsheetInformation(Request $request, $code_number)
    {
        $flowsheets = Flowsheet::where('code_number', $code_number)->get();

        if ($flowsheets) {
            return response()->json($flowsheets);
        } else {
            return response()->json(['error' => 'Flowsheets not found'], 404);
        }
    }

    public function destroy($id)
    {
        $flowsheet = Flowsheet::where('flowsheet_id', $id)->first();
    
        if ($flowsheet) {
            $flowsheet->delete();
            return response()->json(['success' => 'Flowsheet deleted successfully', 'flowsheet' => $flowsheet]);
    
        } else {
            return response()->json(['error' => 'Flowsheet not found']);
        }
    }

    public function edit($id)
    {
    $flowsheet = Flowsheet::find($id);

    if ($flowsheet) {
        return response()->json($flowsheet);
    } else {
        return response()->json(['error' => 'Flowsheet not found']);
    }
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'breathing' => 'sometimes|nullable|string',
            'pulse' => 'sometimes|nullable|string',
            'bp_systolic' => 'sometimes|nullable|integer',
            'bp_diastolic' => 'sometimes|nullable|integer',
            'rhythm_on_check' => 'sometimes|nullable|string',
            'rhythm_with_pulse' => 'sometimes|nullable|string',
            'rhythm_intervention' => 'sometimes|nullable|string',
            'joules' => 'sometimes|nullable|integer',
            'epinephrine_dose' => 'sometimes|nullable|numeric',
            'epinephrine_route' => 'sometimes|nullable|string',
            'amiodarone_dose' => 'sometimes|nullable|numeric',
            'amiodarone_route' => 'sometimes|nullable|string',
            'lidocaine_dose' => 'sometimes|nullable|numeric',
            'lidocaine_route' => 'sometimes|nullable|string',
            'free1_label' => 'sometimes|nullable|string',
            'free1_dose' => 'sometimes|nullable|numeric',
            'free1_route' => 'sometimes|nullable|string',
            'free2_label' => 'sometimes|nullable|string',
            'free2_dose' => 'sometimes|nullable|numeric',
            'free2_route' => 'sometimes|nullable|string',
            'comments' => 'sometimes|nullable|string',
        ]);

        $flowsheet = Flowsheet::find($id);

        if (!$flowsheet) {
            return response()->json(['error' => 'Flowsheet not found'], 404);
        }

        $flowsheet->update($validatedData);

        return response()->json(['success' => 'Flowsheet updated successfully', 'flowsheet' => $flowsheet]);
    }

    


}
