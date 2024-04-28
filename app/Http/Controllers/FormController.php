<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\CodeBlueActivation;
use App\Models\InitialResuscitation;
use App\Models\Flowsheet;
use App\Models\Outcome;
use App\Models\Evaluation;
use App\Models\CodeTeam;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class FormController extends Controller
{
    //VIEW FUNCTION IN CASE IN THE FUTURE
    public function viewCodeBlue($patient_pin, $code_number)
    {
        // Fetch information from each table based on the code_number
        $patient = Patient::where('patient_pin', $patient_pin)->first();
        $codeBlueActivation = CodeBlueActivation::where('code_number', $code_number)->first();
        $initialResuscitation = InitialResuscitation::where('code_number', $code_number)->first();
        $flowsheet = Flowsheet::where('code_number', $code_number)->first();
        $outcome = Outcome::where('code_number', $code_number)->first();
        $evaluation = Evaluation::where('code_number', $code_number)->first();
        $codeTeam = CodeTeam::where('code_number', $code_number)->first();

        // Pass the data to the view
        return view('view_code_blue', compact('patient', 'codeBlueActivation', 'initialResuscitation', 'flowsheet', 'outcome', 'evaluation', 'codeTeam'));
    }
    
    //DELETE FUNCTION IN CASE IN THE FUTURE
    // public function deleteCodeBlueForms($code_number) {
    //     // Delete all records associated with the specified code blue forms event
    //     CodeBlueActivation::where('code_number', $code_number)->delete();

    //     // Redirect back or to a specific route after deletion
    //     return redirect('codeblueforms');
    // }
    
    public function archive(Request $request, $codeNumber)
    {
        $codeBlueActivation = CodeBlueActivation::where('code_number', $codeNumber)->first();
        
        if ($codeBlueActivation) {
            $codeBlueActivation->update(['is_archived' => true]);
    
            // Handle archiving related records
            $codeBlueActivation->initialResuscitation()->update(['is_archived' => true]);
            $codeBlueActivation->flowsheet()->update(['is_archived' => true]);
            $codeBlueActivation->outcome()->update(['is_archived' => true]);
            $codeBlueActivation->evaluation()->update(['is_archived' => true]);
            $codeBlueActivation->codeTeam()->update(['is_archived' => true]);
    
            // Optionally handle archiving the connected patient
            $codeBlueActivation->patient->update(['is_archived' => true]);
    
            return redirect()->back()->with('success', 'Code Blue Activation Event archived successfully.');
        }
    
        return redirect()->back()->with('error', 'Code Blue Activation Event not found.');
    }

    public function unarchive(Request $request, $codeNumber)
    {
        $codeBlueActivation = CodeBlueActivation::where('code_number', $codeNumber)->first();

        if ($codeBlueActivation) {
            $codeBlueActivation->update(['is_archived' => false]);

            // Handle unarchiving related records if needed
            $codeBlueActivation->initialResuscitation()->update(['is_archived' => false]);
            $codeBlueActivation->flowsheet()->update(['is_archived' => false]);
            $codeBlueActivation->outcome()->update(['is_archived' => false]);
            $codeBlueActivation->evaluation()->update(['is_archived' => false]);
            $codeBlueActivation->codeTeam()->update(['is_archived' => false]);
    
            // Optionally handle unarchiving the connected patient
            $codeBlueActivation->patient->update(['is_archived' => false]);

            return redirect()->back()->with('success', 'Code Blue Activation Event unarchived successfully.');
        }

        return redirect()->back()->with('error', 'Code Blue Activation Event not found.');
    }

    public function finalize(Request $request, $codeNumber)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'code_team_leader_password' => 'required',
        ]);
    
        $codeBlueActivation = CodeBlueActivation::where('code_number', $codeNumber)->first();
    
        if ($codeBlueActivation) {
            // Check if the provided password matches the code team leader's password
            $password = $validatedData['code_team_leader_password'];
    
            // Assuming you're using Eloquent and the User model
            $codeTeamLeader = User::join('code_teams', 'users.name', '=', 'code_teams.code_team_leader')
                ->where('code_teams.code_number', $codeNumber)
                ->first();
    
            // dd($codeTeamLeader);
    
            if ($codeTeamLeader) {
                // Check if the password is correct
                if (Hash::check($password, $codeTeamLeader->password)) {
                    // Password is correct, finalize the event
                    $codeBlueActivation->update(['is_finalized' => true]);
    
                    return redirect()->back()->with('success', 'Code Blue Activation Event finalized successfully.');
                } else {
                    // Password is incorrect, show an error message
                    session(['error_code_number' => $codeNumber]);
                    session(['error' => 'Incorrect code team leader password.']);
                    return redirect()->back()->with('error', 'Incorrect code team leader password.');
                }
            } else {
                // Code team leader not found, show an error message
                session(['error_code_number' => $codeNumber]);
            session(['error' => 'Code team leader not found.']);
                return redirect()->back()->with('error', 'Code team leader not found.');
            }
        }
        session(['error_code_number' => $codeNumber]);
        session(['error' => 'Code Blue Activation Event not found.']);
        return redirect()->back()->with('error', 'Code Blue Activation Event not found.');
    }    

    public function index()
    {

        $resuscitationEvents = CodeBlueActivation::distinct()
            ->select('table1.patient_pin',
            'table2.code_number',
            'table1.created_at',
            'table1.location',
            'table1.first_name',
            'table1.last_name',
            'table2.code_start_dt',
            'table3.code_end_dt',
            'table4.code_team_leader',
            'table2.is_finalized' // Include the is_finalized column
            )
        ->from('patients as table1')
        ->leftjoin('code_blue_activations as table2', 'table1.patient_pin', '=', 'table2.patient_pin')
        ->leftjoin('outcomes as table3', 'table2.code_number', '=', 'table3.code_number')
        ->leftjoin(
            DB::raw('(SELECT code_number, MAX(created_at) AS max_created_at FROM code_teams GROUP BY code_number) AS latest_teams'),
            'table2.code_number',
            '=',
            'latest_teams.code_number'
        )
        ->leftjoin('code_teams as table4', function ($join) {
            $join->on('table2.code_number', '=', 'table4.code_number');
            $join->on('table4.created_at', '=', 'latest_teams.max_created_at');
        })       
        ->where('table2.is_archived', false) // Add this condition to filter out archived events
        ->orderBy('table1.created_at', 'desc')
        ->get();

        return view('includes/codeblueforms', compact('resuscitationEvents'));
    }
}