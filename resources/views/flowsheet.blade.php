@extends('layouts.master')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Your Page Title</title>
    <!-- Other head elements if any -->
</head>
<body>
    <!-- Your page content goes here -->

    <!-- Your JavaScript includes go here -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- Other script includes, if any -->

    <!-- Your JavaScript code goes here -->
    <script>
        // Include the CSRF token in your AJAX requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Your existing JavaScript code here
    </script>
</body>
</html>



<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="..." crossorigin="anonymous" />
<style>
    /* Style for the floating container */
    .floating-container {
        position: fixed;
        top: 200px; /* Adjust as needed */
        left: 0px; /* Adjust as needed */
        z-index: 1000;
    }

    /* Style for the timer container */
    .timer-container {
        background-color: #f8f8f8;
        border: 1px solid #ddd;
        padding: 8px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        cursor: move;
        position: absolute; /* Ensure the position is absolute */
        transition: box-shadow 0.3s ease-in-out; /* Smooth transition for box-shadow */
    }

    /* Style for indicating draggable on hover */
    .timer-container:hover {
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
    }

    /* Style for the timer header */
    .timer-header {
        font-size: 20px;
        margin-bottom: 10px;
        text-align: center;
    }

    /* Style for the elapsed time */
    .elapsed-time {
        font-size: 24px;
        text-align: center;
        margin-bottom: 15px;
    }

    /* Style for the timer buttons */
    .timer-buttons {
        display: flex;
        justify-content: center;
    }

    /* Style for the individual timer buttons */
    .timer-button {
        padding: 8px 15px;
        margin: 0 5px;
        font-size: 14px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease-in-out;
    }

    /* Style for the button hover effect */
    .timer-button:hover {
        background-color: #e0e0e0;
    }

    #patientPinDropdown {
        position: absolute;
        z-index: 1000; /* Adjust the z-index as needed to ensure it's above other elements */
        width: 90%; /* Set the width to match the input field */
        box-shadow: 0 5px 5px rgba(0, 0, 0, 0.2);
    }

    .question-mark-btn {
        position: fixed;
        bottom: 20px; /* Adjust the distance from the bottom */
        right: 20px; /* Adjust the distance from the right */
        z-index: 1000; /* Ensure it's above other elements */
    }

    #dropdownMenuButton{
        position: fixed;
        top: 100px; /* Adjust the distance from the bottom */
        left: 20px; /* Adjust the distance from the right */
        z-index: 1000; /* Ensure it's above other elements */
    }

    .fixed-header {
            display: flex;
            text-align: center;
            justify-content: center;
            align-content: center;
            position: fixed;
            top: 70px; /* Adjust as needed based on your header height */
            left: 0;
            right: 0;
            z-index: 1;
            background-color: #ECECF1; /* Adjust background color if needed */
            padding: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .fixed-header a.btn {
            width: 16%;
            margin-left: 5px; /* Adjust spacing between buttons */
        }

        .fixed-header a.btn.btn-secondary {
            background-color: #ECECF1;
            color: #000; /* Text color */
            border-color: #ECECF1; /* Border color */
        }

        .custom-btn {
            margin-right: 5px; 
        }


    </style>

<button type="button" class="btn btn-primary question-mark-btn" data-toggle="modal" data-target="#jumbotronModal">
  ?
</button>

<!-- Modal -->
<div class="modal fade" id="jumbotronModal" tabindex="-1" role="dialog" aria-labelledby="jumbotronModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="jumbotron">
  <h1 class="display-10">Flowsheet</h1>
  <p class="lead">Flowsheet and Medication</p>
        </div>
      </div>
    </div>
  </div>
</div>
            
<div class="fixed-header">
    <a class="btn btn-secondary" href="{{ route('maininformation', ['code_number' => $code_number]) }}">Main Information</a>
    <a class="btn btn-secondary" href="{{ route('initialresuscitation', ['code_number' => $code_number]) }}">Initial Resuscitation</a>
    <a class="btn btn-secondary" style="color: #fff; background-color: #6c757d" href="{{ route('flowsheet', ['code_number' => $code_number]) }}">Flowsheet</a>
    <a class="btn btn-secondary" href="{{ route('outcome', ['code_number' => $code_number]) }}">Outcome of the Code</a>
    <a class="btn btn-secondary" href="{{ route('evaluation', ['code_number' => $code_number]) }}">Debriefing and Evaluation</a>
    <a class="btn btn-secondary" href="{{ route('codeteam', ['code_number' => $code_number]) }}">Code Team</a>
</div>

<div class="row">
  <div class="col-auto">
    <button type="button" class="btn btn-primary btn-sm" id="showTable">
      <i class="fas fa-table"></i>
    </button>
    <button type="button" class="btn btn-primary btn-sm" id="refreshForm">
      <i class="fas fa-undo"></i>
    </button>
  </div>
  <div class="col-auto ml-auto">
    <form method="GET" action="{{ route('outcome', ['code_number' => $code_number ?? '']) }}">
      @csrf
      <button type="submit" class="btn btn-primary btn-sm">
        <i class="fas fa-arrow-right"></i>
      </button>
    </form>
  </div>
</div>

<div id="formContainer">
    <form id="baseForm" method="POST" action="{{ route('store_flowsheet', ['code_number' => $code_number ?? '']) }}"> 
        @csrf
    
        <input type="hidden" name="flowsheet_id" id="flowsheet_id" value="">

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                <p id="editMode" style="display: none;">Edit mode</p>
                
                <div class="card">
                <div class="card-header bg-secondary text-white py-2">Flowsheet</div>
                <div class="card-body">

                        <div class="row">
                            <!-- First Column -->
                            <div class="col-md-6">
                                <div class="form-group">
                                <label for="breathing">Breathing</label>
                                    <select name="breathing" class="form-control" id="breathing">
                                    @php
                                        $selectedBreathing = old('breathing', optional($flowsheet ?? '' ?? '')->breathing ?? ''); 
                                    @endphp

                                    @foreach(['', 'Spontaneous', 'Assisted'] as $option)
                                        <option value="{{ $option }}" {{ $selectedBreathing === $option ? 'selected' : '' }}>
                                            {{ $option }}
                                        </option>
                                    @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                <label for="pulse">Pulse</label>
                                    <select name="pulse" class="form-control" id="pulse">
                                        <option value="">Select an option</option>
                                        <option value="Spontaneous">Spontaneous</option>
                                        <option value="Assisted">Assisted</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="bp_systolic">Blood Pressure, Systolic (mmHg):</label>
                                    <input type="number" class="form-control" name="bp_systolic" placeholder="0" id="bp_systolic">
                                </div>

                                <div class="form-group">
                                    <label for="bp_diastolic">Blood Pressure, Diastolic (mmHg):</label>
                                    <input type="number" class="form-control" name="bp_diastolic" placeholder="0" id="bp_diastolic">
                                </div>                
                            </div>

                            <!-- Second Column -->
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="rhythm_on_check">Rhythm on Check</label>
                                    <select name="rhythm_on_check" id="rhythm_on_check" class="form-control">
                                        <option value="">Select an option</option>
                                        <option value="Ventricular Fibrillation (VF)">Ventricular Fibrillation (VF)</option>
                                        <option value="Pulseless Ventricular Tachycardia (pVT)">Pulseless Ventricular Tachycardia (pVT)</option>
                                        <option value="Asystole">Asystole</option>
                                        <option value="Pulseless Electrical Activity (PEA)">Pulseless Electrical Activity (PEA)</option>
                                        <option value="With Pulse">With Pulse</option>
                                    </select>
                                </div>

                                <div class="form-group" id="rhythmWithPulseGroup" style="display: none;">
                                    <label for="rhythm_with_pulse">Rhythm, with pulse:</label>
                                    <select name="rhythm_with_pulse" id="rhythm_with_pulse" class="form-control">
                                        <option value="">Select an option</option>
                                        <option value="Normal sinus rhythm">Normal sinus rhythm</option>
                                        <option value="Sinus bradycardia">Sinus bradycardia</option>
                                        <option value="Junctional rhythm">Junctional rhythm</option>
                                        <option value="Idioventricular rhythm">Idioventricular rhythm</option>
                                        <option value="AV Block">AV Block</option>
                                        <option value="Sinus pause">Sinus pause</option>
                                        <option value="Slow Atrial fibrillation">Slow Atrial fibrillation</option>
                                        <option value="Sinus tachycardia">Sinus tachycardia</option>
                                        <option value="Supraventricular tachycardia">Supraventricular tachycardia</option>
                                        <option value="Atrial flutter">Atrial flutter</option>
                                        <option value="Rapid Atrial fibrillation">Rapid Atrial fibrillation</option>
                                        <option value="Multifocal atrial tachycardia">Multifocal atrial tachycardia</option>
                                        <option value="Ventricular tachycardia">Ventricular tachycardia</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="rhythm_intervention">Rhythm Intervention</label>
                                    <select name="rhythm_intervention" id="rhythm_intervention" class="form-control">
                                        <option value="">Select an option</option>
                                        <option value="Defibrillation">Defibrillation</option>
                                        <option value="Cardioversion">Cardioversion</option>
                                        <option value="None, continued chest compressions">None, continued chest compressions</option>
                                        <option value="Others, pharmacologic">Others, pharmacologic</option>
                                    </select>
                                </div>
                                
                                <div class="form-group" id="joulesField" style="display: none;">
                                    <label for="joules">Joules:</label>
                                    <input type="number" class="form-control" name="joules" placeholder="0" id="joules">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <div class="card">
                <div class="card-header card-header bg-secondary text-white py-2">Medication</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <!-- First Column -->
                                    <div class="form-group">
                                        <label for="epinephrine_dose">Epinephrine Dose Given (mg):</label>
                                        <input type="number" class="form-control" name="epinephrine_dose" pattern="\d+(\.\d{1})?" placeholder="00.0" step="0.1" id="epinephrine_dose">
                                    </div>

                                    <div class="form-group">
                                    <label for="epinephrine_route">Epinephrine Route</label>
                                        <select name="epinephrine_route" class="form-control" id="epinephrine_route">
                                            <option value="">Select an option</option>
                                            <option value="Intravenous">Intravenous</option>
                                            <option value="Intraosseous">Intraosseous</option>
                                            <option value="Endotracheal">Endotracheal</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="amiodarone_dose">Amiodarone Dose Given (mg):</label>
                                        <input type="number" class="form-control" name="amiodarone_dose" pattern="\d+(\.\d{1})?" placeholder="00.0" step="0.1" id="amiodarone_dose">
                                    </div>

                                    <div class="form-group">
                                    <label for="amiodarone_route">Amiodarone Route</label>
                                        <select name="amiodarone_route" class="form-control" id="amiodarone_route">
                                            <option value="">Select an option</option>
                                            <option value="Intravenous">Intravenous</option>
                                            <option value="Intraosseous">Intraosseous</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="lidocaine_dose">Lidocaine Dose Given (mg):</label>
                                        <input type="number" class="form-control" name="lidocaine_dose" pattern="\d+(\.\d{1})?" placeholder="00.0" step="0.1" id="lidocaine_dose">
                                    </div>

                                    <div class="form-group">
                                    <label for="lidocaine_route">Lidocaine Route</label>
                                        <select name="lidocaine_route" class="form-control" id="lidocaine_route">
                                            <option value="">Select an option</option>
                                            <option value="Intravenous">Intravenous</option>
                                            <option value="Intraosseous">Intraosseous</option>
                                        </select>
                                    </div>            
                                </div>

                                <!-- Second Column -->
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="free1_label">Other Medications (indicate unit of measure)</span></label>
                                        <input type="text" class="form-control" name="free1_label" placeholder="[Other medication #1]" id="free1_label">
                                    </div>

                                    <div class="form-group">
                                        <label for="free1_dose">Dose</span></label>
                                        <input type="number" class="form-control" name="free1_dose" id="free1_dose" pattern="\d+(\.\d{1})?" placeholder="00.0" step="0.1">    
                                    </div>

                                    <div class="form-group">
                                    <label for="free1_route">Route</label>
                                        <input type="text" class="form-control" name="free1_route" id="free1_route">
                                    </div>

                                    <div class="form-group">
                                        <label for="free2_label">Other Medications (indicate unit of measure)</span></label>
                                        <input type="text" class="form-control" name="free2_label" placeholder="[Other medication #2]" id="free2_label">
                                    </div>

                                    <div class="form-group">
                                        <label for="free2_dose">Dose</span></label>
                                        <input type="number" class="form-control" name="free2_dose" id="free2_dose" pattern="\d+(\.\d{1})?" placeholder="00.0" step="0.1">    
                                    </div>

                                    <div class="form-group">
                                    <label for="free2_route">Route</label>
                                        <input type="text" class="form-control" name="free2_route" id="free2_route">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="comments">Comments:</label>
                                    <textarea type="text" class="form-control" name="comments" id="comments"></textarea>
                            </div>
                        </div>          
                    </div>
                    <button type="submit" class="btn btn-primary btn-block" id="logButton">Log</button>
                    <button type="submit" class="btn btn-primary btn-block" id="saveButton" style="display: none;">Save</button>

                    </form>    
                </div>
            </div>
        </div>
    </form>
</div>
<div class="modal fade" id="tableModal" tabindex="-1" role="dialog" aria-labelledby="tableModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tableModalLabel">Flowsheet Table</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      @if(!is_null($flowsheets ?? '' ?? ''))

      <table class="table">
        <thead class="thead-dark">
            <tr>
                <th>Log Time</th>
                <th>Last Edited</th>
                <th>Breathing</th>
                <th>Pulse</th>
                <th>Blood Pressure, Systolic</th>
                <th>Blood Pressure, Diastolic</th>
                <th>Rhythm on check</th>
                <th>Rhythm with pulse</th>
                <th>Rhythm Intervention</th>
                <th>Joules</th>
                <th>Epinephrine Dose</th>
                <th>Epinephrine Route</th>
                <th>Amiodarone Dose</th>
                <th>Amiodarone Route</th>
                <th>Lidocaine Dose</th>
                <th>Lidocaine Route</th>
                <th>Free 1 Label</th>   
                <th>Free 1 Dose</th>
                <th>Free 1 Route</th>
                <th>Free 2 Label</th>
                <th>Free 2 Dose</th>
                <th>Free 2 Route</th>
                <th>Comments</th>  
                <th>Actions</th> 
            </tr>
        </thead>
        <tbody id="flowsheetTableBody">
            @foreach ($flowsheets ?? [] as $flowsheet)
            <tr>
                <td>{{ $flowsheet->log_time ?? '' }}</td>
                <td>{{ $flowsheet->last_edited_time ?? '' }}</td>
                <td>{{ $flowsheet->breathing ?? '' }}</td>
                <td>{{ $flowsheet->pulse ?? '' }}</td>
                <td>{{ $flowsheet->bp_systolic ?? '' }}</td>
                <td>{{ $flowsheet->bp_diastolic ?? '' }}</td>
                <td>{{ $flowsheet->rhythm_on_check ?? '' }}</td>
                <td>{{ $flowsheet->rhythm_with_pulse ?? '' }}</td>
                <td>{{ $flowsheet->rhythm_intervention ?? '' }}</td>
                <td>{{ $flowsheet->joules ?? '' }}</td>
                <td>{{ $flowsheet->epinephrine_dose ?? '' }}</td>
                <td>{{ $flowsheet->epinephrine_route ?? '' }}</td>
                <td>{{ $flowsheet->amiodarone_dose ?? '' }}</td>
                <td>{{ $flowsheet->amiodarone_route ?? '' }}</td>
                <td>{{ $flowsheet->lidocaine_dose ?? '' }}</td>
                <td>{{ $flowsheet->lidocaine_route ?? '' }}</td>
                <td>{{ $flowsheet->free1_label ?? '' }}</td>
                <td>{{ $flowsheet->free1_dose ?? '' }}</td>
                <td>{{ $flowsheet->free1_route ?? '' }}</td>
                <td>{{ $flowsheet->free2_label ?? '' }}</td>
                <td>{{ $flowsheet->free2_dose ?? '' }}</td>
                <td>{{ $flowsheet->free2_route ?? '' }}</td>
                <td>{{ $flowsheet->comments ?? '' }}</td>
                <td>
                <div class="btn-group" role="group">
                    <button class="btn btn-primary btn-sm custom-btn" onclick="editRow({{ $flowsheet->id }})">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button class="btn btn-danger btn-sm custom-btn" onclick="deleteRow({{ $flowsheet->id }})">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

        @else
          <p>No flowsheet data available.</p>
        @endif
      </div>
    </div>
  </div>
</div>

<!-- Add this inside your content section -->
<div class="floating-container">
    <div id="timerContainer" class="timer-container">
        <div class="icon-container">
            <i class="fas fa-arrows-alt" style=" display: flex; align-items: center; justify-content: center; margin-bottom: 10px; "></i>
        </div>
        <h3 class="timer-header">Timer</h3>
        <p id="elapsedTime" class="elapsed-time">00:00:00</p>
        <div class="timer-buttons">
            <button id="startStopButton" class="timer-button">Start</button>
            <button id="resetButton" class="timer-button">Reset</button>
        </div>
    </div>
</div>


<!-- Add this JavaScript at the end of your content section -->
<script>
    const timerContainer = document.getElementById('timerContainer');
    let offsetX, offsetY;
    let isDragging = false;

    timerContainer.addEventListener('mousedown', function (event) {
        event.preventDefault();
        offsetX = event.clientX - timerContainer.getBoundingClientRect().left;
        offsetY = event.clientY - timerContainer.getBoundingClientRect().top;
        isDragging = true;
    });

    document.addEventListener('mousemove', function (event) {
        if (isDragging) {
            event.preventDefault();
            const x = event.clientX - offsetX;
            const y = event.clientY - offsetY;

            timerContainer.style.left = `${x}px`;
            timerContainer.style.top = `${y}px`;
        }
    });

    document.addEventListener('mouseup', function () {
        isDragging = false;
    });

    let timerInterval = null;
    let timerRunning = false;
    let elapsedTime = 1;

    function startStopTimer() {
        if (!timerRunning) {
            startTimer();
            document.getElementById('startStopButton').textContent = 'Stop';
        } else {
            stopTimer();
            document.getElementById('startStopButton').textContent = 'Resume';
        }
    }

    function startTimer() {
        timerRunning = true;
        timerInterval = setInterval(() => {
            const hours = Math.floor(elapsedTime / 3600);
            const minutes = Math.floor((elapsedTime % 3600) / 60);
            const seconds = elapsedTime % 60;
            document.getElementById('elapsedTime').textContent = `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
            elapsedTime++;
        }, 1000);
    }

    function stopTimer() {
        clearInterval(timerInterval);
        timerRunning = false;
    }

    function resetTimer() {
        stopTimer();
        elapsedTime = 0;
        document.getElementById('elapsedTime').textContent = '00:00:00';
        document.getElementById('startStopButton').textContent = 'Start';
    }

    document.getElementById('startStopButton').addEventListener('click', startStopTimer);
    document.getElementById('resetButton').addEventListener('click', resetTimer);
</script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var data;

            // Event listener for the modal close event
        $('#tableModal').on('hidden.bs.modal', function () {
            // Update the modal content when it is closed
            fetchAndFillTable();
        });

        // Your JavaScript code here
        document.getElementById('showTable').addEventListener('click', function () {
            var $tableModal = $('#tableModal');

            // Check if the modal is already initialized and fully shown
            if ($tableModal.hasClass('in') && $tableModal.hasClass('show')) {
                fetchAndFillTable();
            } else {
                // Use the modal's 'shown.bs.modal' event to ensure it's fully loaded
                $tableModal.on('shown.bs.modal', function () {
                    fetchAndFillTable();
                }).modal('show');
            }
        });

});

function fetchAndFillTable() {
    // Make an AJAX request to the Laravel route to fetch flowsheet information
    $.ajax({
        url: '{{ route("fetchFlowsheetInformation", ["code_number" => $code_number]) }}',
        method: 'GET',
        success: function (data) {
    // Data is an array of flowsheets
    if (data && data.length > 0) {
        console.log('Data received successfully');
        // Update the data variable with the response data (no need to change this line)
        // data = responseData; // This line is not needed
        populateTable(data); // Populate the table with the received data
    } else {
        // Handle case where no data is returned
        console.log('No flowsheet data available.');
    }
},
        error: function () {
            // Handle errors if needed
            console.error('Error fetching flowsheet information.');
        }
    });
}

    function populateTable(data) {
        console.log('Data in populateTable:', data);
        var tableBody = $('#flowsheetTableBody');

        // Clear existing rows
        tableBody.empty();

        console.log('Data received:', data);

        if (data && Array.isArray(data)) {
        // Iterate through the flowsheets and append rows to the table
        data.forEach(function (flowsheet) {
            var row = '<tr>' +
                '<td>' + (flowsheet.log_time || '') + '</td>' +
                '<td>' + (flowsheet.last_edited_time || '') + '</td>' +
                '<td>' + (flowsheet.breathing || '') + '</td>' +
                '<td>' + (flowsheet.pulse || '') + '</td>' +
                '<td>' + (flowsheet.bp_systolic || '') + '</td>' +
                '<td>' + (flowsheet.bp_diastolic || '') + '</td>' +
                '<td>' + (flowsheet.rhythm_on_check || '') + '</td>' +
                '<td>' + (flowsheet.rhythm_with_pulse || '') + '</td>' +
                '<td>' + (flowsheet.rhythm_intervention || '') + '</td>' +
                '<td>' + (flowsheet.joules || '') + '</td>' +
                '<td>' + (flowsheet.epinephrine_dose || '') + '</td>' +
                '<td>' + (flowsheet.epinephrine_route || '') + '</td>' +
                '<td>' + (flowsheet.amiodarone_dose || '') + '</td>' +
                '<td>' + (flowsheet.amiodarone_route || '') + '</td>' +
                '<td>' + (flowsheet.lidocaine_dose || '') + '</td>' +
                '<td>' + (flowsheet.lidocaine_route || '') + '</td>' +
                '<td>' + (flowsheet.free1_label || '') + '</td>' +
                '<td>' + (flowsheet.free1_dose || '') + '</td>' +
                '<td>' + (flowsheet.free1_route || '') + '</td>' +
                '<td>' + (flowsheet.free2_label || '') + '</td>' +
                '<td>' + (flowsheet.free2_dose || '') + '</td>' +
                '<td>' + (flowsheet.free2_route || '') + '</td>' +
                '<td>' + (flowsheet.comments || '') + '</td>' +
                '<td>' +
                '<div class="btn-group" role="group">' +
                    '<button class="btn btn-primary btn-sm custom-btn" onclick="editRow(' + flowsheet.flowsheet_id + ')"><i class="fas fa-edit"></i></button>' +
                    '<button class="btn btn-danger btn-sm custom-btn" onclick="deleteRow(' + flowsheet.flowsheet_id + ')"><i class="fas fa-trash"></i></button>' +
                '</div>';

                '</td>' +
            '</tr>';
            tableBody.append(row);
        });
    } else {
        console.error('Invalid or missing data for populating the table.');
    } 
    }

    function deleteRow(id) {
    // Display a confirmation dialog
    var confirmDelete = confirm('Are you sure you want to delete this entry?');

    if (confirmDelete) {
        // Get the CSRF token
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        // Send the CSRF token in the request headers
        $.ajax({
            url: '/destroy/' + id,
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function (response) {
                console.log('Delete request successful:', response);

                // Fetch and fill the table after successful deletion
                fetchAndFillTable();

                // Redirect to the flowsheet with the correct code_number
                var code_number = '{{ $code_number }}'; // Include the PHP value here
                window.location.href = '/flowsheet/' + code_number;
            },
            error: function (error) {
                console.error('Error deleting row:', error);
            }
        });
    }
}



    function editRow(id) {
        $.ajax({
            url: '/edit/' + id,
            method: 'GET',
            success: function (response) {
                // Set the flowsheet_id for updating
                $('#baseForm #flowsheet_id').val(response.id);

                //Show edit mode text
                $('#editMode').show();

                $('#logButton').hide();
                $('#saveButton').show();

                // Populate the form fields with the fetched data
                populateForm(response);

                //Hide table modal
                $('#tableModal').modal('hide'); 
            },
            error: function (error) {
                console.error('Error fetching flowsheet data for edit:', error);
            }

        });
    }

    function populateForm(data) {
    // Populate the form fields with the fetched data
    $('#baseForm #breathing').val(data.breathing);
    $('#baseForm #pulse').val(data.pulse);
    $('#baseForm #bp_systolic').val(data.bp_systolic);
    $('#baseForm #bp_diastolic').val(data.bp_diastolic);
    $('#baseForm #rhythm_on_check').val(data.rhythm_on_check);
    $('#baseForm #rhythm_with_pulse').val(data.rhythm_with_pulse);
    $('#baseForm #rhythm_intervention').val(data.rhythm_intervention);
    $('#baseForm #joules').val(data.joules);
    $('#baseForm #epinephrine_dose').val(data.epinephrine_dose);
    $('#baseForm #epinephrine_route').val(data.epinephrine_route);
    $('#baseForm #amiodarone_dose').val(data.amiodarone_dose);
    $('#baseForm #amiodarone_route').val(data.amiodarone_route);
    $('#baseForm #lidocaine_dose').val(data.lidocaine_dose);
    $('#baseForm #lidocaine_route').val(data.lidocaine_route);
    $('#baseForm #free1_label').val(data.free1_label);
    $('#baseForm #free1_dose').val(data.free1_dose);
    $('#baseForm #free1_route').val(data.free1_route);
    $('#baseForm #free2_label').val(data.free2_label);
    $('#baseForm #free2_dose').val(data.free2_dose);
    $('#baseForm #free2_route').val(data.free2_route);
    $('#baseForm #comments').val(data.comments);

    // Set the entry ID in a hidden field
    $('#baseForm #flowsheet_id').val(data.flowsheet_id);

    const rhythmIntervention = data.rhythm_intervention;
    const joulesField = $('#baseForm #joules');

    if (rhythmIntervention === 'Defibrillation' || rhythmIntervention === 'Cardioversion') {
        joulesField.closest('.form-group').show();
    } else {
        joulesField.closest('.form-group').hide();
    }

    // Display rhythmWithPulseGroup based on rhythm_on_check value
    const rhythmOnCheck = data.rhythm_on_check;
    const rhythmWithPulseGroup = $('#baseForm #rhythmWithPulseGroup');

    if (rhythmOnCheck === 'With Pulse') {
        rhythmWithPulseGroup.show();
    } else {
        rhythmWithPulseGroup.hide();
    }
}


    // Handle form submission
    $('#baseForm').submit(function (e) {
        e.preventDefault();

        // Check if there's a flowsheet ID
        var flowsheetId = $('#flowsheet_id').val();

        console.log(flowsheetId)

        // Get the form action attribute
        var formAction = $('#baseForm').attr('action');

        // Use a regular expression to extract the code_number from the form action
        var codeNumberMatch = formAction.match(/\/store\/([^\/]*)/);

        // Check if a match is found
        if (codeNumberMatch && codeNumberMatch.length > 1) {
            var codeNumber = codeNumberMatch[1];
            
            // Determine the route for the form submission
            var action = flowsheetId ? '/update/' + flowsheetId : '/store/' + codeNumber;

            if (flowsheetId) {
                // If it's an update, use AJAX        
                updateEntryWithAjax(action);
            } else {
                // If it's a new entry, submit the form normally

                submitFormNormally(action);
            } 
        } else {
            console.error("Code Number not found in the form action");
        }  
    });

    function updateEntryWithAjax(action) {
    // Send an AJAX request
    $.ajax({
    url: action,
    method: 'PUT',  // Ensure this is set to PUT
    data: $('#baseForm').serialize(),
    success: function (response) {
    },
    error: function (error) {
        console.error('Error updating flowsheet entry:', error);
    }
    });
    }

    function submitFormNormally(action) {
    // Submit the form normally (without AJAX)
    $('#baseForm')[0].action = action;
    $('#baseForm')[0].method = 'POST'; // Adjust the method as needed
    $('#baseForm')[0].submit();
    }


    function updateTableRow(data) {
    // Update the corresponding row in the table with the edited or new data
    var tableRow = $('#flowsheetTableBody tr[data-id="' + data.id + '"]');

    // Update each cell in the row with the new data
    tableRow.find('td:eq(0)').text(data.log_time || '');
    tableRow.find('td:eq(1)').text(data.last_edited_time || '');
    tableRow.find('td:eq(2)').text(data.breathing || '');
    tableRow.find('td:eq(3)').text(data.pulse || '');
    tableRow.find('td:eq(4)').text(data.bp_systolic || '');
    tableRow.find('td:eq(5)').text(data.bp_diastolic || '');
    tableRow.find('td:eq(6)').text(data.rhythm_on_check || '');
    tableRow.find('td:eq(7)').text(data.rhythm_with_pulse || '');
    tableRow.find('td:eq(8)').text(data.rhythm_intervention || '');
    tableRow.find('td:eq(9)').text(data.joules || '');
    tableRow.find('td:eq(10)').text(data.epinephrine_dose || '');
    tableRow.find('td:eq(11)').text(data.epinephrine_route || '');
    tableRow.find('td:eq(12)').text(data.amiodarone_dose || '');
    tableRow.find('td:eq(13)').text(data.amiodarone_route || '');
    tableRow.find('td:eq(14)').text(data.lidocaine_dose || '');
    tableRow.find('td:eq(15)').text(data.lidocaine_route || '');
    tableRow.find('td:eq(16)').text(data.free1_label || '');
    tableRow.find('td:eq(17)').text(data.free1_dose || '');
    tableRow.find('td:eq(18)').text(data.free1_route || '');
    tableRow.find('td:eq(19)').text(data.free2_label || '');
    tableRow.find('td:eq(20)').text(data.free2_dose || '');
    tableRow.find('td:eq(21)').text(data.free2_route || '');
    tableRow.find('td:eq(22)').text(data.comments || '');

    // Optionally, you can also highlight the updated row to provide visual feedback
    tableRow.addClass('updated-row');

    // Remove the 'updated-row' class after a brief delay (e.g., 3 seconds)
    setTimeout(function () {
        tableRow.removeClass('updated-row');
    }, 3000);
    }

    const rhythmInterventionSelect = document.getElementById('rhythm_intervention');
    const joulesField = document.getElementById('joulesField');

    function toggleJoulesField() {
        const selectedValue = rhythmInterventionSelect.value;

        if (selectedValue === 'Defibrillation' || selectedValue === 'Cardioversion') {
            joulesField.style.display = 'block';
            joulesField.querySelector('input').setAttribute('required', 'true');
        } else {
            joulesField.style.display = 'none';
            joulesField.querySelector('input').removeAttribute('required');
        }
    }

    toggleJoulesField(); // Initial toggle based on selected outcome

    rhythmInterventionSelect.addEventListener('change', toggleJoulesField);

    const rhythmOnCheckSelect = document.getElementById('rhythm_on_check');
    const rhythmWithPulseGroup = document.getElementById('rhythmWithPulseGroup');

    function toggleRhythmWithPulse() {
        const selectedValue = rhythmOnCheckSelect.value;

        if (selectedValue === 'With Pulse') {
            rhythmWithPulseGroup.style.display = 'block';
        } else {
            rhythmWithPulseGroup.style.display = 'none';
        }
    }

    toggleRhythmWithPulse(); // Initial toggle based on selected outcome

    rhythmOnCheckSelect.addEventListener('change', toggleRhythmWithPulse);

    $('#refreshForm').click(function() {
    // Clear the form fields
    $('#baseForm #breathing').val('');
    $('#baseForm #pulse').val('');
    $('#baseForm #bp_systolic').val('');
    $('#baseForm #bp_diastolic').val('');
    $('#baseForm #rhythm_on_check').val('');
    $('#baseForm #rhythm_with_pulse').val('');
    $('#baseForm #rhythm_intervention').val('');
    $('#baseForm #joules').val('');
    $('#baseForm #epinephrine_dose').val('');
    $('#baseForm #epinephrine_route').val('');
    $('#baseForm #amiodarone_dose').val('');
    $('#baseForm #amiodarone_route').val('');
    $('#baseForm #lidocaine_dose').val('');
    $('#baseForm #lidocaine_route').val('');
    $('#baseForm #free1_label').val('');
    $('#baseForm #free1_dose').val('');
    $('#baseForm #free1_route').val('');
    $('#baseForm #free2_label').val('');
    $('#baseForm #free2_dose').val('');
    $('#baseForm #free2_route').val('');
    $('#baseForm #comments').val('');

    // Clear the entry ID
    $('#baseForm #flowsheet_id').val('');

    //Show edit mode text
    $('#editMode').hide();

    $('#saveButton').hide();
    $('#logButton').show();

    joulesField.style.display = 'none';
    joulesField.querySelector('input').removeAttribute('required');
});

</script>
@endsection