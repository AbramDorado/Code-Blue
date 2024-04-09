@extends('layouts.master')

@section('content')
<style>
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

        /* Add this CSS to style the disabled buttons */
        .fixed-header a.btn.btn-secondary.disabled {
            pointer-events: none; /* Disable click events */
            opacity: 0.6; /* Reduce opacity to visually indicate disabled state */
            cursor: not-allowed; /* Change cursor to indicate not allowed */
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
          <h1 class="display-4">Pre-Hospital Care Report</h1>
          <p class="lead">Pre-Hospital Care Report</p>
        </div>
      </div>
    </div>
  </div>
</div>
            
<div class="fixed-header">
    <a class="btn btn-secondary" style="color: #fff; background-color: #6c757d" >Pre-Hospital Care Report</a>
    <a id="initialResuscitationBtn" class="btn btn-secondary" >Level of Consciousness</a>
    <a class="btn btn-secondary" href="{{ route('samplehistory') }}">Sample History</a>
    <!-- Add additional buttons below -->
    <a id="outcomeBtn" class="btn btn-secondary" >Vital Signs</a>
    <a id="evaluationBtn" class="btn btn-secondary" >Head To Toe Assesment</a>
    <a id="codeteamBtn" class="btn btn-secondary" >Receiving Medical Facility Information</a>
    <!-- Add more buttons if needed -->
</div>




<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">


    <form method="POST" action="{{ route('store_medicalinfo') }}"> <!--start of the form submittion-->
        @csrf


        <div class="card">
            <div class="card-header bg-secondary text-white py-2">Patient's Personal Information</div>
            <div class="card-body">

                <label style="font-size: larger; font-weight: bold;">Patient:</label>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="full_name">Patient Name:</label>
                            <input type="text" class="form-control" name="full_name" placeholder="Full Name" value="{{ old('full_name', optional($patient ?? '')->full_name) }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="contact_num_p">Contact Number:</label>
                            <input type="number" class="form-control" name="contact_num_p" placeholder="Contact Number" value="{{ old('contact_num_p', optional($patient ?? '')->contact_num_p) }}">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="address_p">Address:</label>
                    <input type="text" class="form-control" name="address_p" placeholder="Address" value="{{ old('address_p', optional($patient ?? '')->address_p) }}">
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="sex">Sex:</label>
                            <select class="form-control" name="sex">
                                <option value="">Select a sex</option>
                                <option value="male" {{ old('sex', optional($patient ?? '')->sex) === 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ old('sex', optional($patient ?? '')->sex) === 'female' ? 'selected' : '' }}>Female</option>
                                <option value="other" {{ old('sex', optional($patient ?? '')->sex) === 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="age">Age:</label>
                            <input type="number" class="form-control" name="age" value="{{ old('age', optional($patient ?? '')->age) }}">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="status">Status:</label>
                            <input type="text" class="form-control" name="status" value="{{ old('status', optional($patient ?? '')->status) }}">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="blood_type">Blood Type:</label>
                            <input type="text" class="form-control" name="blood_type" value="{{ old('blood_type', optional($patient ?? '')->blood_type) }}">
                        </div>
                    </div>
                </div>

                <label style="font-size: larger; font-weight: bold;">Companion:</label>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="comps_name">Companion's Name:</label>
                            <input type="text" class="form-control" name="comps_name" placeholder="Full Name" value="{{ old('comps_name', optional($patient ?? '')->comps_name) }}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="relationship">Relationship:</label>
                            <input type="text" class="form-control" name="relationship" value="{{ old('relationship', optional($patient ?? '')->relationship) }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="address_c">Address:</label>
                            <input type="text" class="form-control" name="address_c" placeholder="Address" value="{{ old('address_c', optional($patient ?? '')->address_c) }}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="contact_num_c">Contact Number:</label>
                            <input type="number" class="form-control" name="contact_num_c" placeholder="Contact Number" value="{{ old('contact_num_c', optional($patient ?? '')->contact_num_c) }}">
                        </div>
                    </div>
                </div>

            </div>
        </div>


        <div class="card">
            <div class="card-header card-header bg-secondary text-white py-2">Responders</div>
            <div class="card-body">

                <label style="font-size: larger; font-weight: bold;">Responder's Information:</label>
                <div class="row">
                    <div class="col-md-6">
                        <!-- First Column -->
                        <div class="form-group">
                            <label for="team">Team:</label>
                            <input type="text" class="form-control" name="team" value="{{ old('team', optional($patient ?? '')->team) }}">
                        </div>

                        <div class="form-group">
                            <label for="plate_num">Vehicle Plate No:</label>
                            <input type="text" class="form-control" name="plate_num" value="{{ old('plate_num', optional($patient ?? '')->plate_num) }}">
                        </div>

                        <div class="form-group">
                            <label for="driver">Driver:</label>
                            <input type="text" class="form-control" name="driver" value="{{ old('driver', optional($patient ?? '')->driver) }}">
                        </div>

                        <div class="form-group">
                            <label for="reporter">Reporter:</label>
                            <input type="text" class="form-control" name="reporter" value="{{ old('reporter', optional($patient ?? '')->reporter) }}">
                        </div>

                    </div>

                    <div class="col-md-6">
                        <!-- Second Column -->
                        <div class="form-group">
                            <label for="cameraman">Cameraman:</label>
                            <input type="text" class="form-control" name="cameraman" value="{{ old('cameraman', optional($patient ?? '')->cameraman) }}">
                        </div>

                        <div class="form-group">
                            <label for="team_leader">Team Leader:</label>
                            <input type="text" class="form-control" name="team_leader" value="{{ old('team_leader', optional($patient ?? '')->team_leader) }}">
                        </div>

                        <label>Crew:</label>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="crew1" placeholder="Crew1" value="{{ old('crew1', optional($patient ?? '')->crew1) }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="crew2" placeholder="Crew2" value="{{ old('crew2', optional($patient ?? '')->crew2) }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="crew3" placeholder="Crew3" value="{{ old('crew3', optional($patient ?? '')->crew3) }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="crew4" placeholder="Crew4" value="{{ old('crew4', optional($patient ?? '')->crew4) }}">
                                </div>
                            </div>
                        </div>
    
                    </div>

                </div>

                <label style="font-size: larger; font-weight: bold;">Response Details:</label>
                <div class="row">
                    <div class="col-md-6">
                        <!-- First Column -->
                        <div class="form-group">
                            <label for="departure_base_time">Time of Departure from base:</label>
                            <input type="time" class="form-control" name="departure_base_time" value="{{ old('departure_base_time', optional($patient ?? '')->departure_base_time ? (\Carbon\Carbon::parse($patient['departure_base_time'])->format('H:i')) : '') }}">
                        </div>

                        <div class="form-group">
                            <label for="arrival_scene_time">Time of Arrival at the Scene:</label>
                            <input type="time" class="form-control" name="arrival_scene_time" value="{{ old('arrival_scene_time', optional($patient ?? '')->arrival_scene_time ? (\Carbon\Carbon::parse($patient['arrival_scene_time'])->format('H:i')) : '') }}">
                        </div>

                        <div class="form-group">
                            <label for="arrival_hospital_time">Time of Arrival at the Hospital:</label>
                            <input type="time" class="form-control" name="arrival_hospital_time" value="{{ old('arrival_hospital_time', optional($patient ?? '')->arrival_hospital_time ? (\Carbon\Carbon::parse($patient['arrival_hospital_time'])->format('H:i')) : '') }}">
                        </div>
                    </div>

                    <div class="col-md-6">  
                        <!-- Second Column -->
                        <div class="form-group">
                            <label for="departure_hospital_time">Time of Departure at the Hospital:</label>
                            <input type="time" class="form-control" name="departure_hospital_time" value="{{ old('departure_hospital_time', optional($patient ?? '')->departure_hospital_time ? (\Carbon\Carbon::parse($patient['departure_hospital_time'])->format('H:i')) : '') }}">
                        </div>

                        <div class="form-group">
                            <label for="arrival_base_time">Time of Arrival at the base:</label>
                            <input type="time" class="form-control" name="arrival_base_time" value="{{ old('arrival_base_time', optional($patient ?? '')->arrival_base_time ? (\Carbon\Carbon::parse($patient['arrival_base_time'])->format('H:i')) : '') }}">
                        </div>
                    </div>
                </div>


            </div>
        </div>


        <div class="card">
            <div class="card-header card-header bg-secondary text-white py-2">Incident Information</div>
            <div class="card-body">

                <div class="form-group">
                    <label for="incident_dt">Date/Time of Incident:</label>
                    <input type="datetime-local" class="form-control" name="incident_dt" value="{{ old('incident_dt', optional($patient ?? '')->incident_dt ? (\Carbon\Carbon::parse($patient['incident_dt'])->format('Y-m-d H:i:s')) : '') }}">
                </div>

                <div class="form-group">
                    <label for="location">Location:</label>
                    <input type="text" class="form-control" name="location" value="{{ old('location', optional($patient ?? '')->location) }}">
                </div>
                
                <div class="form-group">
                    <label>Type of Incident:</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="incident_type[]" value="Trauma">
                        <label class="form-check-label" for="trauma">Trauma</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="incident_type[]" value="Medical">
                        <label class="form-check-label" for="medical">Medical</label>
                    </div>
                </div>


                <!-- Nature of Incident -->
                <div class="form-group">
                    <label for="nature_of_incident">Nature of Incident:</label><br>
                    <select class="form-control" name="nature_of_incident">
                        <option value="" disabled selected>Select</option>
                        <option value="Vehicular Accident">Vehicular Accident</option>
                        <option value="Motorcycle Accident">Motorcycle Accident</option>
                        <option value="Fire">Fire</option>
                        <option value="Assault">Assault</option>
                        <option value="Disaster">Disaster</option>
                        <option value="Patient Conduction">Patient Conduction</option>
                        <option value="Others">Others</option>
                    </select>
                </div>
                
                <!-- Remarks -->
                <div class="form-group">
                    <label for="remarks">Remarks on Incident:</label>
                    <input type="text" class="form-control" name="remarks">
                </div>

            </div>
        </div>
        

        <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-chevron-right" aria-hidden="true"></i></button> <!-- Added btn-block class for width -->
    </form> <!--end of the form submission-->

  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    // Function to handle the selection of a patient PIN from the dropdown
    function selectPatientPin(patientPin) {
        // Fill the patient PIN input with the selected value
        $('#patient_pin').val(patientPin);

        // Call the function to fetch patient information based on patient PIN
        fetchAndFillPatientInformation(patientPin);

        // Hide the dropdown
        $('#patientPinDropdown').hide();
    }

    // Function to fetch patient information based on patient PIN
    function fetchAndFillPatientInformation(patientPin) {
        // Make an AJAX request to the Laravel route to fetch patient information
        $.ajax({
            url: '{{ route("fetchPatientInformation") }}',
            method: 'GET',
            data: { patient_pin: patientPin },
            success: function (data) {
                // Fill out the patient information fields with the retrieved data
                $('[name="visit_number"]').val(data.visit_number);
                $('[name="first_name"]').val(data.first_name);
                $('[name="last_name"]').val(data.last_name);
                $('[name="middle_name"]').val(data.middle_name);
                $('[name="suffix"]').val(data.suffix);
                $('[name="birthday"]').val(data.birthday);
                $('[name="age"]').val(data.age);
                $('[name="sex"]').val(data.sex);
                $('[name="height"]').val(data.height);
                $('[name="weight"]').val(data.weight);
                $('[name="allergies"]').val(data.allergies);
                $('[name="location"]').val(data.location);
                // ... Add other fields as needed
            },
            error: function () {
                // Handle errors if needed
            }
        });
    }

        $(document).ready(function () {
            // Reference to the dropdown
            var dropdown = $('#patientPinDropdown');

            // Listen for input changes on the patient PIN field
            $('#patient_pin').on('input', function () {
                // Get the entered value
                var inputVal = $(this).val();

                // Hide the dropdown if the input is empty
                if (inputVal.trim() === '') {
                    dropdown.hide();
                    return;
                }

                // Make an AJAX request to the Laravel route to fetch matching patient PINs
                $.ajax({
                    url: '{{ route("searchPatientPins") }}',
                    method: 'GET',
                    data: { patient_pin: inputVal },
                    success: function (data) {
                        console.log('Received data:', data);

                        // Ensure the data is an array
                        if (!Array.isArray(data)) {
                            console.error('Invalid data format. Expected an array.');
                            dropdown.hide();
                            return;
                        }

                        // Filter data based on similarity to the input
                        var filteredData = data.filter(function (option) {
                            // Ensure each option is a number before using includes
                            return (typeof option === 'number' && option.toString().includes(inputVal));
                        });

                        console.log('Filtered data:', filteredData);

                        // Display the matching options in a dropdown
                        dropdown.empty();

                        // Append each matching option to the dropdown
                        filteredData.forEach(function (option) {
                            dropdown.append('<div class="dropdown-item" onclick="selectPatientPin(' + option + ')">' + option + '</div>');
                        });

                        // Show the dropdown
                        dropdown.show();
                    },
                    error: function (xhr, status, error) {
                        console.error('Error:', error);
                        // Hide the dropdown in case of an error
                        dropdown.hide();
                    }
                });
            });

                });
    </script>

<script>
$(document).ready(function() {
    // Check if the patient PIN exists
    var patientPIN = "{{ old('patient_pin', optional($patient ?? '')->patient_pin) }}";

    if (patientPIN !== '') {
        // If patient PIN exists, enable buttons
        $("#initialResuscitationBtn, #flowsheetBtn, #outcomeBtn, #evaluationBtn, #codeteamBtn").removeClass('disabled');
    }
});
</script>

<script>
    $(document).ready(function() {
        $('[name="birthday"]').on('blur change', function() {
            calculateAge();
        });

        function calculateAge() {
            var birthdayInput = $('[name="birthday"]').val();
            var ageInput = $('[name="age"]');

            if (birthdayInput) {
                var dob = new Date(birthdayInput);
                var today = new Date();

                var age = today.getFullYear() - dob.getFullYear();

                if (today.getMonth() < dob.getMonth() || (today.getMonth() === dob.getMonth() && today.getDate() < dob.getDate())) {
                    age--;
                }

                ageInput.val(age);
            } else {
                ageInput.val('');
            }
        }
    });
</script> 

<!-- Add this script to toggle the visibility of the other reporter text input -->
<script>
    $(document).ready(function () {
        // Initially hide the other reporter text input
        $('#other_reporter').hide();

        // Listen for changes in the initial reporter select box
        $('#initial_reporter').on('change', function () {
            // If "other" is selected, show the text input; otherwise, hide it
            if ($(this).val() === 'other') {
                $('#other_reporter').show();
            } else {
                $('#other_reporter').hide();
            }
        });
    });
</script>

@endsection