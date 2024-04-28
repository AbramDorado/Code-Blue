<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MedicalInformation;
use App\Models\LevelOfConsciousness;
use App\Models\SampleHistory;
use App\Models\VitalSigns;
use App\Models\HTAssessment;
use App\Models\RMFInformation;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class FirstAiderController extends Controller
{
    //VIEW FUNCTION IN CASE IN THE FUTURE
    public function viewForms($patient_id)
    {
        // Fetch information from each table based on the code_number
        $prehospital = MedicalInformation::where('patient_id', $patient_id)->first();
        $levelofconsciousness = LevelOfConsciousness::where('patient_id', $patient_id)->first();
        $samplehistory = SampleHistory::where('patient_id', $patient_id)->first();
        $vitalsigns = VitalSigns::where('patient_id', $patient_id)->first();
        $htassessment = HTAssessment::where('patient_id', $patient_id)->first();
        $rmfinformation = RMFInformation::where('patient_id', $patient_id)->first();

        // Pass the data to the view
        return view('prehospital', compact('prehospital', 'levelofconsciousness', 'samplehistory', 'vitalsigns', 'htassessment', 'rmfinformation'));
    }
    
    //DELETE FUNCTION IN CASE IN THE FUTURE
    // public function deleteCodeBlueForms($code_number) {
    //     // Delete all records associated with the specified code blue forms event
    //     CodeBlueActivation::where('code_number', $code_number)->delete();

    //     // Redirect back or to a specific route after deletion
    //     return redirect('codeblueforms');
    // }
    
    /////////////////////////////////////////////////////////////////////////////////////////////////////////// wait lang
    // public function archive(Request $request, $patient_id)
    // {
    //     $prehospital = MedicalInformation::where('patient_id', $patient_id)->first();
        
    //     if ($prehospital) {
    //         $prehospital->update(['is_archived' => true]);
    
    //         // Handle archiving related records
    //         $prehospital->levelofconsciousness()->update(['is_archived' => true]);
    //         $prehospital->flowsheet()->update(['is_archived' => true]);
    //         $prehospital->samplehistory()->update(['is_archived' => true]);
    //         $prehospital->vitalsigns()->update(['is_archived' => true]);
    //         $prehospital->rmfinformation()->update(['is_archived' => true]);
    
    //         // Optionally handle archiving the connected patient
    //         $prehospital->patient->update(['is_archived' => true]);
    
    //         return redirect()->back()->with('success', 'Pre Hospital Care Event archived successfully.');
    //     }
    
    //     return redirect()->back()->with('error', 'Pre Hospital Care Event not found.');
    // }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////// wait lang
    // public function unarchive(Request $request, $codeNumber)
    // {
    //     $codeBlueActivation = CodeBlueActivation::where('code_number', $codeNumber)->first();

    //     if ($codeBlueActivation) {
    //         $codeBlueActivation->update(['is_archived' => false]);

    //         // Handle unarchiving related records if needed
    //         $codeBlueActivation->initialResuscitation()->update(['is_archived' => false]);
    //         $codeBlueActivation->flowsheet()->update(['is_archived' => false]);
    //         $codeBlueActivation->outcome()->update(['is_archived' => false]);
    //         $codeBlueActivation->evaluation()->update(['is_archived' => false]);
    //         $codeBlueActivation->codeTeam()->update(['is_archived' => false]);
    
    //         // Optionally handle unarchiving the connected patient
    //         $codeBlueActivation->patient->update(['is_archived' => false]);

    //         return redirect()->back()->with('success', 'Code Blue Activation Event unarchived successfully.');
    //     }

    //     return redirect()->back()->with('error', 'Code Blue Activation Event not found.');
    // }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////// wait lang
    // public function finalize(Request $request, $codeNumber)
    // {
    //     // Validate the form data
    //     $validatedData = $request->validate([
    //         'code_team_leader_password' => 'required',
    //     ]);
    
    //     $codeBlueActivation = CodeBlueActivation::where('code_number', $codeNumber)->first();
    
    //     if ($codeBlueActivation) {
    //         // Check if the provided password matches the code team leader's password
    //         $password = $validatedData['code_team_leader_password'];
    
    //         // Assuming you're using Eloquent and the User model
    //         $codeTeamLeader = User::join('code_teams', 'users.name', '=', 'code_teams.code_team_leader')
    //             ->where('code_teams.code_number', $codeNumber)
    //             ->first();
    
    //         // dd($codeTeamLeader);
    
    //         if ($codeTeamLeader) {
    //             // Check if the password is correct
    //             if (Hash::check($password, $codeTeamLeader->password)) {
    //                 // Password is correct, finalize the event
    //                 $codeBlueActivation->update(['is_finalized' => true]);
    
    //                 return redirect()->back()->with('success', 'Code Blue Activation Event finalized successfully.');
    //             } else {
    //                 // Password is incorrect, show an error message
    //                 session(['error_code_number' => $codeNumber]);
    //                 session(['error' => 'Incorrect code team leader password.']);
    //                 return redirect()->back()->with('error', 'Incorrect code team leader password.');
    //             }
    //         } else {
    //             // Code team leader not found, show an error message
    //             session(['error_code_number' => $codeNumber]);
    //         session(['error' => 'Code team leader not found.']);
    //             return redirect()->back()->with('error', 'Code team leader not found.');
    //         }
    //     }
    //     session(['error_code_number' => $codeNumber]);
    //     session(['error' => 'Code Blue Activation Event not found.']);
    //     return redirect()->back()->with('error', 'Code Blue Activation Event not found.');
    // }    

    public function index()
    {

        $prehospitalEvents = MedicalInformation::select(
            'patient_id',
            'full_name',
            'contact_num_p',
            'address_p',
            'sex',
            'age',
            'blood_type'
        )->get();

        return view('includes/prehospitalcare', compact('prehospitalEvents'));
    }
}