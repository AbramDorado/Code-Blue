<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Evaluation;
use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    private $evaluation;

    public function index($code_number)
    {
        $questions = Evaluation::where('code_number', $code_number)
        ->orderBy('created_at', 'desc')
        ->first();
        // dd($questions);
        return view('evaluation', compact('code_number', 'questions'));
    } 

    public function store(Request $request, $code_number)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'question1' => 'sometimes|nullable|in:Yes,No',
            'question2' => 'sometimes|nullable|in:Yes,No',
            'question2_1' => 'sometimes|nullable|string',
            'question3' => 'sometimes|nullable|in:Yes,No',
            'question4' => 'sometimes|nullable|in:Yes,No',
            'question4_1' => 'sometimes|nullable|string',
            'question5' => 'sometimes|nullable|in:Yes,No',
            'question5_1' => 'sometimes|nullable|string',
            'question6' => 'sometimes|nullable|in:Yes,No',
            'question7' => 'sometimes|nullable|string',
            // Questions 3_1 to 3_14
            'question3_1' => 'sometimes|nullable',
            'question3_2' => 'sometimes|nullable',
            'question3_3' => 'sometimes|nullable',
            'question3_4' => 'sometimes|nullable',
            'question3_5' => 'sometimes|nullable',
            'question3_6' => 'sometimes|nullable',
            'question3_7' => 'sometimes|nullable',
            'question3_8' => 'sometimes|nullable',
            'question3_9' => 'sometimes|nullable',
            'question3_10' => 'sometimes|nullable',
            'question3_11' => 'sometimes|nullable',
            'question3_12' => 'sometimes|nullable',
            'question3_13' => 'sometimes|nullable',
            'question3_14' => 'sometimes|nullable',
        ]);     
        
        $existingEvaluation = Evaluation::where('code_number', $code_number)->first();

        if ($existingEvaluation) {
            return $this->updateEvaluation($request, $existingEvaluation, $code_number);
        }

        $evaluation = new Evaluation();

        $evaluation->question1 = $validatedData['question1'] ?? null;
        $evaluation->question2 = $validatedData['question2'] ?? null;
        $evaluation->question2_1 = $validatedData['question2_1'] ?? null;
        $evaluation->question3 = $validatedData['question3'] ?? null;
        $evaluation->question3_1 = $validatedData['question3_1'] ?? null;
        $evaluation->question3_2 = $validatedData['question3_2'] ?? null;
        $evaluation->question3_3 = $validatedData['question3_3'] ?? null;
        $evaluation->question3_4 = $validatedData['question3_4'] ?? null;
        $evaluation->question3_5 = $validatedData['question3_5'] ?? null;
        $evaluation->question3_6 = $validatedData['question3_6'] ?? null;
        $evaluation->question3_7 = $validatedData['question3_7'] ?? null;
        $evaluation->question3_8 = $validatedData['question3_8'] ?? null;
        $evaluation->question3_9 = $validatedData['question3_9'] ?? null;
        $evaluation->question3_10 = $validatedData['question3_10'] ?? null;
        $evaluation->question3_11 = $validatedData['question3_11'] ?? null;
        $evaluation->question3_12 = $validatedData['question3_12'] ?? null;
        $evaluation->question3_13 = $validatedData['question3_13'] ?? null;
        $evaluation->question3_14 = $validatedData['question3_14'] ?? null;
        $evaluation->question4 = $validatedData['question4'] ?? null;
        $evaluation->question4_1 = $validatedData['question4_1'] ?? null;
        $evaluation->question5 = $validatedData['question5'] ?? null;
        $evaluation->question5_1 = $validatedData['question5_1'] ?? null;
        $evaluation->question6 = $validatedData['question6'] ?? null;
        $evaluation->question7 = $validatedData['question7'] ?? null;
        $evaluation->code_number =  $code_number;

        // Save the evaluation to the database
        $evaluation->code_number =  $code_number;
        $evaluation->save();
      
        return redirect()->route('codeteam', ['code_number' => $code_number]);

    }

    public function updateEvaluation(Request $request, Evaluation $existingEvaluation, $code_number)
    {
        $existingEvaluation->fill($request->all());
        $existingEvaluation->save();
        
        return redirect()->route('codeteam', ['code_number' => $code_number]);
    }
}
