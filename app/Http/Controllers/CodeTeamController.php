<?php

namespace App\Http\Controllers;

use App\Models\CodeTeam;
use Illuminate\Http\Request;

class CodeTeamController extends Controller

{
    private $codeTeam;

    public function index($code_number)
    {
        $usersController = new UserController();
        $users = $usersController->getNames();
        return view('codeteam', compact('code_number', 'users'));
    }

    public function showCodeTeamForm($code_number)
    {
        $usersController = new UserController();
        $users = $usersController->getNames();
        return view('codeteam', ['code_number' => $code_number, 'users' => $users]);
    }

    public function store(Request $request, $code_number)
    {
        // dd(session()->all());
        // Validate the form data
        $validatedData = $request->validate([
            'code_team_leader' => 'required',
            'code_team_co_leader' => 'nullable',
            'recorder' => 'required',
            'code_team_member' => 'nullable|array',
            'intubated_by' => 'nullable',
            // Add validation rules for other fields as needed
        ]);

        // Check if 'code_team_co_leader' is set, if not, set it to null
        $code_team_co_leader = isset($validatedData['code_team_co_leader']) ? $validatedData['code_team_co_leader'] : null;

        // Check if 'code_team_member' is set, if not, set it to an empty array
        $code_team_member = isset($validatedData['code_team_member']) ? implode(',', $validatedData['code_team_member']) : null;

        // Check if 'intubated_by' is set, if not, set it to null
        $intubated_by = isset($validatedData['intubated_by']) ? $validatedData['intubated_by'] : null;

        // Create a new CodeTeam instance and fill it with the user's responses
        $codeTeam = new CodeTeam();
        $codeTeam->code_team_leader = $validatedData['code_team_leader'];
        $codeTeam->code_team_co_leader = $code_team_co_leader;
        $codeTeam->recorder = $validatedData['recorder'];
        $codeTeam->code_team_member = $code_team_member;
        $codeTeam->intubated_by = $intubated_by;

        // Save the CodeTeam instance to the database
        $codeTeam->code_number = $code_number;
        $codeTeam->save();

        // Redirect back to the 'codeteam' view with the old input data
        return redirect()->route('includes/codeblueforms');
    }
}
