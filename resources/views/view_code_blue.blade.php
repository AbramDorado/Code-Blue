<!-- resources/views/view_code_blue.blade.php -->

@extends('layouts.master')

@section('content')
    <!-- Display Main Information -->
    <div class="card">
        <div class="card-header">
            <h2>Main Information</h2>
        </div>
        <div class="card-body">
            <div class="card">
                <div class="card-header bg-secondary text-white py-2">Patient Information</div>
                <div class="card-body">
                    <div class="row">


                        <!-- First Column -->
                        <div class="col-md-6">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>Patient PIN:</th>
                                        <td>{{ $patient->patient_pin ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Patient Visit/Encounter Number:</th>
                                        <td>{{ $patient->visit_number ?? 'N/A'  }}</td>
                                    </tr>
                                    <tr>
                                    <tr>
                                        <th>Patient Name:</th>
                                        <td>{{ $patient->first_name }}<br>
                                        {{ $patient->last_name ?? 'N/A'  }}<br>
                                        {{ $patient->middle_name ?? 'N/A'  }}<br>
                                        {{ $patient->suffix ?? 'N/A'  }}</td>
                                    </tr>
                                    <tr>
                                        <th>Date of Birth:</th>
                                        <td>{{ $patient->birthday ?? 'N/A'  }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Second Column -->
                        <div class="col-md-6">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>Age:</th>
                                        <td>{{ $patient->age ?? 'N/A'  }}</td>
                                    </tr>
                                    <tr>
                                        <th>Height:</th>
                                        <td>{{ $patient->height ?? 'N/A'  }}</td>
                                    </tr>
                                    <tr>
                                        <th>Weight:</th>
                                        <td>{{ $patient->weight ?? 'N/A'  }}</td>
                                    </tr>
                                    <tr>
                                        <th>Allergies:</th>
                                        <td>{{ $patient->allergies ?? 'N/A'  }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>


                    </div>
                </div>
            </div> 


            <div class="card">
                <div class="card-header bg-secondary text-white py-2">Code Blue Activation</div>
                <div class="card-body">
                    <div class="row">


                        <!-- First Column -->
                        <div class="col-md-6">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>Code Number:</th>
                                        <td>{{ $codeBlueActivation->code_number ?? 'N/A'  }}</td>
                                    </tr>
                                    <tr>
                                        <th>Date/Time of Activation of Code:</th>
                                        <td>{{ $codeBlueActivation->code_start_dt ?? 'N/A'  }}</td>
                                    </tr>
                                    <tr>
                                        <th>Date/Time of Arrest:</th>
                                        <td>{{ $codeBlueActivation->arrest_dt ?? 'N/A'  }}</td>
                                    </tr>
                                    <tr>
                                        <th>Reason for Code Blue Activation:</th>
                                        <td>{{ $codeBlueActivation->reason_for_activation ?? 'N/A'  }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Second Column -->
                        <div class="col-md-6">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>Initially Reported By:</th>
                                        <td>{{ $codeBlueActivation->initial_reporter ?? 'N/A'  }}</td>
                                    </tr>
                                    <tr>
                                        <th>Date/Time Code Team Arrival:</th>
                                        <td>{{ $codeBlueActivation->code_team_arrival_dt ?? 'N/A'  }}</td>
                                    </tr>
                                    <tr>
                                        <th>Date/Time e-Cart Arrival:</th>
                                        <td>{{ $codeBlueActivation->e_cart_arrival_dt ?? 'N/A'  }}</td>
                                    </tr>
                                    <tr>
                                        <th>Witnessed?</th>
                                        <td>{{ $codeBlueActivation->witnessed ?? 'N/A'  }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>


                    </div>
                </div>
            </div> 


        </div>
    </div>  

    <!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
    
    <!-- Display Initial Resuscitation -->
    <div class="card mt-4">
        <div class="card-header">
            <h2>Initial Resuscitation</h2>
        </div>
        <div class="card-body">
            
        <div class="card">
                <div class="card-header bg-secondary text-white py-2">Airway/Ventilation</div>
                <div class="card-body">
                    <div class="row">


                        <!-- First Column -->
                        <div class="col-md-6">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>Breathing upon code activation:</th>
                                        <td>{{ $initialResuscitation->breathing_upon_ca ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>First Ventilation:</th>
                                        <td>{{ $initialResuscitation->first_ventilation_dt ?? 'N/A'  }}</td>
                                    </tr>
                                    <tr>
                                    <tr>
                                        <th>Ventilation via:</th>
                                        <td>{{ $initialResuscitation->ventilation ?? 'N/A'  }}</td>
                                    </tr>
                                    <tr>
                                        <th>Other Ventilation Method:</th>
                                        <td>{{ $initialResuscitation->other_ventilation ?? 'N/A'  }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Second Column -->
                        <div class="col-md-6">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>Intubation:</th>
                                        <td>{{ $initialResuscitation->intubation_dt ?? 'N/A'  }}</td>
                                    </tr>
                                    <tr>
                                        <th>ET Tube Size:</th>
                                        <td>{{ $initialResuscitation->et_tube_size ?? 'N/A'  }}</td>
                                    </tr>
                                    <tr>
                                        <th>Number of intubation attempts:</th>
                                        <td>{{ $initialResuscitation->intubation_attempts ?? 'N/A'  }}</td>
                                    </tr>
                                    <tr>
                                        <th>ET Tube Information:</th>
                                        <td>{{ $initialResuscitation->et_tube_information ?? 'N/A'  }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>


                    </div>
                </div>
            </div> 


            <div class="card">
                <div class="card-header bg-secondary text-white py-2">Circulation</div>
                <div class="card-body">
                    <div class="row">


                        <!-- First Column -->
                        <div class="col-md-6">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>1st Documented Rhythm:</th>
                                        <td>{{ $initialResuscitation->first_documented_rhythm ?? 'N/A'  }}</td>
                                    </tr>
                                    <tr>
                                        <th>1st Pulseless Rhythm Detected Date/Time:</th>
                                        <td>{{ $initialResuscitation->first_pulseless_rhythm_dt ?? 'N/A'  }}</td>
                                    </tr>
                                    <tr>
                                        <th>Compressions Started Date/Time:</th>
                                        <td>{{ $initialResuscitation->compressions_dt ?? 'N/A'  }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Second Column -->
                        <div class="col-md-6">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>AED Applied:</th>
                                        <td>{{ $initialResuscitation->aed_applied ?? 'N/A'  }}</td>
                                    </tr>
                                    <tr>
                                        <th>Pacemaker on:</th>
                                        <td>{{ $initialResuscitation->pacemaker_on ?? 'N/A'  }}</td>
                                    </tr>
                                    <tr>
                                        <th>Date/Time:</th>
                                        <td>{{ $initialResuscitation->pacemaker_on_dt ?? 'N/A'  }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>


                    </div>
                </div>
            </div> 


        </div>
    </div>

    <!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->


    <!-- Display Flowsheet -->
    <div class="card mt-4">
        <div class="card-header">
            <h2>Flowsheet</h2>
        </div>
        <div class="card-body">
            
            <div class="card">
                <div class="card-header bg-secondary text-white py-2">Flowsheet</div>
                <div class="card-body">
                    <div class="row">


                        <!-- First Column -->
                        <div class="col-md-6">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>Breathing:</th>
                                        <td>{{ $flowsheet->breathing ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Pulse:</th>
                                        <td>{{ $flowsheet->pulse ?? 'N/A'  }}</td>
                                    </tr>
                                    <tr>
                                    <tr>
                                        <th>Blood Pressure, Systolic:</th>
                                        <td>{{ $flowsheet->bp_systolic ?? 'N/A'  }}</td>
                                    </tr>
                                    <tr>
                                        <th>Blood Pressure, Diastolic:</th>
                                        <td>{{ $flowsheet->bp_diastolic ?? 'N/A'  }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Second Column -->
                        <div class="col-md-6">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>Rhythm on Check:</th>
                                        <td>{{ $flowsheet->rhythm_on_check ?? 'N/A'  }}</td>
                                    </tr>
                                    <tr>
                                        <th>Rhythm, with pulse:</th>
                                        <td>{{ $flowsheet->rhythm_with_pulse ?? 'N/A'  }}</td>
                                    </tr>
                                    <tr>
                                        <th>Rhythm Intervention:</th>
                                        <td>{{ $flowsheet->rhythm_intervention ?? 'N/A'  }}</td>
                                    </tr>
                                    <tr>
                                        <th>Joules:</th>
                                        <td>{{ $flowsheet->joules ?? 'N/A'  }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>


                    </div>
                </div>
            </div> 


            <div class="card">
                <div class="card-header bg-secondary text-white py-2">Medication</div>
                <div class="card-body">
                    <div class="row">


                        <!-- First Column -->
                        <div class="col-md-6">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>Epinephrine Dose Given:</th>
                                        <td>{{ $flowsheet->epinephrine_dose ?? 'N/A'  }}</td>
                                    </tr>
                                    <tr>
                                        <th>Epinephrine Route:</th>
                                        <td>{{ $flowsheet->epinephrine_route ?? 'N/A'  }}</td>
                                    </tr>
                                    <tr>
                                        <th>Amiodarone Dose Given:</th>
                                        <td>{{ $flowsheet->amiodarone_dose ?? 'N/A'  }}</td>
                                    </tr>
                                    <tr>
                                        <th>Amiodarone Route:</th>
                                        <td>{{ $flowsheet->amiodarone_route ?? 'N/A'  }}</td>
                                    </tr>
                                    <tr>
                                        <th>Lidocaine Dose Given:</th>
                                        <td>{{ $flowsheet->lidocaine_dose ?? 'N/A'  }}</td>
                                    </tr>
                                    <tr>
                                        <th>Lidocaine Route:</th>
                                        <td>{{ $flowsheet->lidocaine_route ?? 'N/A'  }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Second Column -->
                        <div class="col-md-6">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>[Free text medication #1]:</th>
                                        <td>{{ $flowsheet->free1_label ?? 'N/A'  }}</td>
                                    </tr>
                                    <tr>
                                        <th>Dose:</th>
                                        <td>{{ $flowsheet->free1_dose ?? 'N/A'  }}</td>
                                    </tr>
                                    <tr>
                                        <th>Route:</th>
                                        <td>{{ $flowsheet->free1_route ?? 'N/A'  }}</td>
                                    </tr>
                                    <tr>
                                        <th>[Free text medication #2]:</th>
                                        <td>{{ $flowsheet->free2_label ?? 'N/A'  }}</td>
                                    </tr>
                                    <tr>
                                        <th>Dose:</th>
                                        <td>{{ $flowsheet->free2_dose ?? 'N/A'  }}</td>
                                    </tr>
                                    <tr>
                                        <th>Route:</th>
                                        <td>{{ $flowsheet->free2_route ?? 'N/A'  }}</td>
                                    </tr>
                                    <tr>
                                        <th>Comments:</th>
                                        <td>{{ $flowsheet->comments ?? 'N/A'  }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>


                    </div>
                </div>
            </div> 


        </div>
    </div>

    <!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->


    <!-- Display Outcome -->
    <div class="card mt-4">
        <div class="card-header">
            <h2>Outcome</h2>
        </div>
        <div class="card-body">
            
            <div class="card">
                <div class="card-header bg-secondary text-white py-2">Outcome</div>
                <div class="card-body">
                    

                    <table class="table">
                        <tbody>
                            <tr>
                                <th>Outcome:</th>
                                <td>{{ $outcome->outcome ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Date and Time of Death:</th>
                                <td>{{ $outcome->death_dt ?? 'N/A'  }}</td>
                            </tr>
                            <tr>
                            <tr>
                                <h2>Assessment</h2>

                                <th>Blood Pressure, Systolic:</th>
                                <td>{{ $outcome->bp_systolic ?? 'N/A'  }}</td>
                            </tr>
                            <tr>
                                <th>Blood Pressure, Diastolic:</th>
                                <td>{{ $outcome->bp_diastolic ?? 'N/A'  }}</td>
                            </tr>
                            <tr>
                                <th>Heart Rate:</th>
                                <td>{{ $outcome->heart_rate ?? 'N/A'  }}</td>
                            </tr>
                            <tr>
                                <th>Respiratory Rate:</th>
                                <td>{{ $outcome->respiratory_rate ?? 'N/A'  }}</td>
                            </tr>
                            <tr>
                                <th>Rhythm:</th>
                                <td>{{ $outcome->rhythm ?? 'N/A'  }}</td>
                            </tr>
                        </tbody>
                    </table>

                    
                </div>
            </div> 


        </div>
    </div>

    <!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->


    <!-- Display Evaluation -->
    <div class="card mt-4">
        <div class="card-header">
            <h2>Evaluation</h2>
        </div>
        <div class="card-body">
            
            <div class="card">
                <div class="card-header bg-secondary text-white py-2">Questions</div>
                <div class="card-body">
                    

                    <table class="table">
                        <tbody>
                            <tr>
                                <th>Question 1:
                                <p>Was the code conducted in accordance with the current algorithm?</p>
                                </th>
                                <td>{{ $evaluation->question1 ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Question 2:
                                <p>Was there any problem with the response time of the team?</p></th>
                                <td>{{ $evaluation->question2 ?? 'N/A'  }}<br>
                                {{ $evaluation->question2_1 ?? 'N/A'  }}</td>
                            </tr>
                            <tr>
                            <tr>
                                <th>Question 3:
                                <p>Were there any problems with equipment, supplies, or tests?</p></th>
                                <td>{{ $evaluation->question3 ?? 'N/A'  }}<br>
                                {{ $evaluation->question3_1 ?? 'N/A'  }}<br>
                                {{ $evaluation->question3_2 ?? 'N/A'  }}<br>
                                {{ $evaluation->question3_3 ?? 'N/A'  }}<br>
                                {{ $evaluation->question3_4 ?? 'N/A'  }}<br>
                                {{ $evaluation->question3_5 ?? 'N/A'  }}<br>
                                {{ $evaluation->question3_6 ?? 'N/A'  }}<br>
                                {{ $evaluation->question3_7 ?? 'N/A'  }}<br>
                                {{ $evaluation->question3_8 ?? 'N/A'  }}<br>
                                {{ $evaluation->question3_9 ?? 'N/A'  }}<br>
                                {{ $evaluation->question3_10 ?? 'N/A'  }}<br>
                                {{ $evaluation->question3_11 ?? 'N/A'  }}<br>
                                {{ $evaluation->question3_12 ?? 'N/A'  }}<br>
                                {{ $evaluation->question3_13 ?? 'N/A'  }}<br>
                                {{ $evaluation->question3_14 ?? 'N/A'  }}
                            </td>
                            </tr>
                            <tr>
                                <th>Question 4:
                                <p>Were policies and procedures followed?</p></th>
                                <td>{{ $evaluation->question4 ?? 'N/A'  }}<br>
                                {{ $evaluation->question4_1 ?? 'N/A'  }}</td>
                            </tr>
                            <tr>
                                <th>Question 5:
                                <p>Were there any problems during the code?</p></th>
                                <td>{{ $evaluation->question5 ?? 'N/A'  }}<br>
                                {{ $evaluation->question5_1 ?? 'N/A'  }}</td>
                            </tr>
                            <tr>
                                <th>Question 6:
                                <p>Was family notified and updated on patient’s condition?</p></th>
                                <td>{{ $evaluation->question6 ?? 'N/A'  }}</td>
                            </tr>
                            <tr>
                                <th>Question 7:
                                <p>Other Remarks</p></th>
                                <td>{{ $evaluation->question7_explanation ?? 'N/A'  }}</td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div> 

        </div>
    </div>

    <!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->


    <!-- Display Code Team -->
    <div class="card mt-4">
        <div class="card-header">
            <h2>Code Team</h2>
        </div>
        <div class="card-body">

        <div class="card">
                <div class="card-header bg-secondary text-white py-2">Code Team</div>
                <div class="card-body">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th>Code Team Leader::</th>
                                <td>{{ $codeTeam->code_team_leader ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Code Team Co-Leader:</th>
                                <td>{{ $codeTeam ? ($codeTeam->code_team_co_leader == -1 ? 'N/A' : $codeTeam->code_team_co_leader) : 'N/A' }}</td>

                            </tr>
                            <tr>
                                <th>Recorder:</th>
                                <td>{{ $codeTeam->recorder ?? 'N/A'  }}</td>
                            </tr>
                            <tr>
                                <th>Code Team Member:</th>
                                <td>{{ $codeTeam->code_team_member ?? 'N/A'  }}</td>
                            </tr>
                            <tr>
                                <th>Intubated by:</th>
                                <td>{{ $codeTeam ? ($codeTeam->intubated_by == -1 ? 'N/A' : $codeTeam->intubated_by) : 'N/A' }}</td>
                            </tr>
                        </tbody>
                    </table>

                    
                </div>
            </div> 


        </div>
    </div>

@endsection
