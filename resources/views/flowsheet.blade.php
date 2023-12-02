@extends('layouts.master')

@section('content')
<div class="jumbotron">
  <h1 class="display-10">Flowsheet</h1>
  <p class="lead">Flowsheet and Medication</p>
  <!-- Add a dropdown button to toggle the menu -->
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Toggle Menu
  </button>
  
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <!-- Your list of buttons goes here -->
    <a class="dropdown-item" href="{{ route('maininformation', ['code_number' => $code_number]) }}">Main Information</a>
    <a class="dropdown-item" href="{{ route('initialresuscitation', ['code_number' => $code_number]) }}">Initial Resuscitation</a>
    <a class="dropdown-item" href="{{ route('flowsheet', ['code_number' => $code_number]) }}">Flowsheet</a>
    <a class="dropdown-item" href="{{ route('outcome', ['code_number' => $code_number]) }}">Outcome of the Code</a>
    <a class="dropdown-item" href="{{ route('evaluation', ['code_number' => $code_number]) }}">Debriefing and Evaluation</a>
    <a class="dropdown-item" href="{{ route('codeteam', ['code_number' => $code_number]) }}">Code Team</a>
  </div>
</div>

<div class="row">
  <div class="col-auto">
    <button type="button" class="btn btn-success btn-sm" id="showTable">
      <i class="fas fa-table"></i>
    </button>
  </div>
  <div class="col-auto ml-auto">
    <form method="GET" action="{{ route('outcome', ['code_number' => $code_number ?? '']) }}">
      @csrf
      <button type="submit" class="btn btn-success btn-sm">
        <i class="fas fa-arrow-right"></i>
      </button>
    </form>
  </div>
</div>

<div id="formContainer">
    <form id="baseForm" method="POST" action="{{ route('store_flowsheet', ['code_number' => $code_number ?? '']) }}"> 
        @csrf
    
        <input name="flowsheet_id" id="flowsheet_id" value="">

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                
                <div class="card">
                <div class="card-header bg-secondary text-white py-2">Flowsheet</div>
                <div class="card-body">

                        <div class="row">
                            <!-- First Column -->
                            <div class="col-md-6">
                                <div class="form-group">
                                <label for="breathing">Breathing:</label>
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
                                <label for="pulse">Pulse:</label>
                                    <select name="pulse" class="form-control" id="pulse">
                                        <option value="">Select an option</option>
                                        <option value="Spontaneous">Spontaneous</option>
                                        <option value="Assisted">Assisted</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="bp_systolic">Blood Pressure, Systolic:</label>
                                    <input type="number" class="form-control" name="bp_systolic" placeholder="0" id="bp_systolic">
                                </div>

                                <div class="form-group">
                                    <label for="bp_diastolic">Blood Pressure, Diastolic:</label>
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

                                <div class="form-group">
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
                                    </select>
                                </div>

                                <div class="form-group">
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
                                        <label for="epinephrine_dose">Epinephrine Dose Given:</label>
                                        <input type="number" class="form-control" name="epinephrine_dose" placeholder="0" id="epinephrine_dose">
                                    </div>

                                    <div class="form-group">
                                    <label for="epinephrine_route">Epinephrine Route:</label>
                                        <select name="epinephrine_route" class="form-control" id="epinephrine_route">
                                            <option value="">Select an option</option>
                                            <option value="Intravenous">Intravenous</option>
                                            <option value="Intraosseous">Intraosseous</option>
                                            <option value="Endotracheal">Endotracheal</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="amiodarone_dose">Amiodarone Dose Given:</label>
                                        <input type="number" class="form-control" name="amiodarone_dose" placeholder="0" id="amiodarone_dose">
                                    </div>

                                    <div class="form-group">
                                    <label for="amiodarone_route">Amiodarone Route:</label>
                                        <select name="amiodarone_route" class="form-control" id="amiodarone_route">
                                            <option value="">Select an option</option>
                                            <option value="Intravenous">Intravenous</option>
                                            <option value="Intraosseous">Intraosseous</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="lidocaine_dose">Lidocaine Dose Given:</label>
                                        <input type="number" class="form-control" name="lidocaine_dose" placeholder="0" id="lidocaine_dose">
                                    </div>

                                    <div class="form-group">
                                    <label for="lidocaine_route">Lidocaine Route:</label>
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
                                        <label for="free1_label">[Free text medication #1]</span></label>
                                        <input type="text" class="form-control" name="free1_label" placeholder="[Free text medication #1]" id="free1_label">
                                    </div>

                                    <div class="form-group">
                                        <label for="free1_dose">Dose</span></label>
                                        <input type="number" class="form-control" name="free1_dose" placeholder="0" id="free1_dose">    
                                    </div>

                                    <div class="form-group">
                                    <label for="free1_route">Route</label>
                                        <input type="text" class="form-control" name="free1_route" id="free1_route">
                                    </div>

                                    <div class="form-group">
                                        <label for="free2_label">[Free text medication #2]</span></label>
                                        <input type="text" class="form-control" name="free2_label" placeholder="[Free text medication #2]" id="free2_label">
                                    </div>

                                    <div class="form-group">
                                        <label for="free2_dose">Dose</span></label>
                                        <input type="number" class="form-control" name="free2_dose" placeholder="0" id="free2_dose">    
                                    </div>

                                    <div class="form-group">
                                    <label for="free2_route">Route:</label>
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

                    </form>    
                </div>
            </div>
        </div>
    </form>
</div>

<div class="modal fade" id="tableModal" role="dialog" aria-labelledby="tableModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tableModalLabel">Flowsheet Table</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      @if(!is_null($flowsheets ?? ''))

          <table class="table">
          <thead>
            <tr>
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
            <th></th> 
            </tr>
        </thead>
        <tbody id="flowsheetTableBody">
            @foreach ($flowsheets ?? [] as $flowsheet)
            <tr>
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
                    <button>Edit</button>
                    <button class="btn btn-danger btn-sm" onclick="deleteRow({{ $flowsheet->id }})">Delete</button>
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

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var data;
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
                '<button onclick="editRow(' + flowsheet.flowsheet_id + ')">Edit</button>' +
                '<button class="btn btn-danger btn-sm" onclick="deleteRow(' + flowsheet.flowsheet_id + ')">Delete</button>' +
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
        $.ajax({
            url: '/destroy/' + id,
            method: 'GET',
            success: function (response) {
                console.log('Delete request successful:', response);
                
                $('#flowsheetTableBody tr[data-id="' + id + '"]').remove();
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
        // Handle success
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
    tableRow.find('td:eq(0)').text(data.breathing || '');
    tableRow.find('td:eq(1)').text(data.pulse || '');
    tableRow.find('td:eq(2)').text(data.bp_systolic || '');
    tableRow.find('td:eq(3)').text(data.bp_diastolic || '');
    tableRow.find('td:eq(4)').text(data.rhythm_on_check || '');
    tableRow.find('td:eq(5)').text(data.rhythm_with_pulse || '');
    tableRow.find('td:eq(6)').text(data.rhythm_intervention || '');
    tableRow.find('td:eq(7)').text(data.joules || '');
    tableRow.find('td:eq(8)').text(data.epinephrine_dose || '');
    tableRow.find('td:eq(9)').text(data.epinephrine_route || '');
    tableRow.find('td:eq(10)').text(data.amiodarone_dose || '');
    tableRow.find('td:eq(11)').text(data.amiodarone_route || '');
    tableRow.find('td:eq(12)').text(data.lidocaine_dose || '');
    tableRow.find('td:eq(13)').text(data.lidocaine_route || '');
    tableRow.find('td:eq(14)').text(data.free1_label || '');
    tableRow.find('td:eq(15)').text(data.free1_dose || '');
    tableRow.find('td:eq(16)').text(data.free1_route || '');
    tableRow.find('td:eq(17)').text(data.free2_label || '');
    tableRow.find('td:eq(18)').text(data.free2_dose || '');
    tableRow.find('td:eq(19)').text(data.free2_route || '');
    tableRow.find('td:eq(20)').text(data.comments || '');

    // Optionally, you can also highlight the updated row to provide visual feedback
    tableRow.addClass('updated-row');

    // Remove the 'updated-row' class after a brief delay (e.g., 3 seconds)
    setTimeout(function () {
        tableRow.removeClass('updated-row');
    }, 3000);
    }




</script>
@endsection