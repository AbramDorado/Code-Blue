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
        .solid-line {
        border-top: 2px solid #a9a9a9; /* Adjust the color code to your desired darker color */
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
          <h1 class="display-4">Vital Signs</h1>
          <p class="lead">Vital Signs</p>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="fixed-header">
    <a class="btn btn-secondary" href="{{ route('prehospital') }}" >Pre-Hospital Care Report</a>
    <a class="btn btn-secondary" href="{{ route('levelofconsciousness') }}" >Level of Consciousness</a>
    <a class="btn btn-secondary" href="{{ route('samplehistory') }}" >Sample History</a>
    <a class="btn btn-secondary" style="color: #fff; background-color: #6c757d">Vital Signs</a>
    <a class="btn btn-secondary" href="{{ route('htassessment') }}" >Head To Toe Assessment</a>
    <a class="btn btn-secondary" href="{{ route('rmfinformation') }}" >Receiving Medical Facility Information</a>
</div>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">

    <form method="POST" action="{{ route('store_vitalsigns') }}"> <!--start of the form submittion-->
        @csrf
        <div class="card">
            <div class="card-header bg-secondary text-white py-2">Vital Signs</div>
            <div class="card-body">

                <label style="font-size: larger; font-weight: bold;">Baseline:</label>

                <div class="row align-items-center"> <!-- Add align-items-center class here -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="vs_1st_time">Time:</label>
                            <input type="time" class="form-control" name="vs_1st_time" value="{{ old('vs_1st_time', optional($vitalsigns ?? '')->vs_1st_time ? (\Carbon\Carbon::parse($vitalsigns['vs_1st_time'])->format('H:i')) : '') }}">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="blood_pressure1">Blood Pressure (mmHg):</label>
                            <input type="text" class="form-control" name="blood_pressure1" placeholder="0/0" id="blood_pressure1">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="respiratory_rate1">Respiratory Rate (bpm):</label>
                            <input type="number" class="form-control" name="respiratory_rate1" placeholder="0" id="respiratory_rate1">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="pulse_rate1">Pulse Rate (bpm):</label>
                            <input type="number" class="form-control" name="pulse_rate1" placeholder="0" id="pulse_rate1">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="oxygen_sat1">Oxygen Saturation (SpO2%):</label>
                            <input type="number" class="form-control" name="oxygen_sat1" placeholder="0" id="oxygen_sat1">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="skin_color1">Skin Color:</label>
                            <input type="text" class="form-control" name="skin_color1" placeholder="Normal, Pale, Flushed, Bluish" id="skin_color1">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="skin_temp1">Skin Temperature:</label>
                            <input type="text" class="form-control" name="skin_temp1" placeholder="Normal, Hot, Cold" id="skin_temp1">
                        </div>
                    </div>

                </div> <!-- close align-items-center div -->

                <hr class="solid-line my-4"> <!-- Add a horizontal line with custom class -->

                <label style="font-size: larger; font-weight: bold;">2nd:</label>

                <div class="row align-items-center"> <!-- Add align-items-center class here -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="vs_2nd_time">Time:</label>
                            <input type="time" class="form-control" name="vs_2nd_time" value="{{ old('vs_2nd_time', optional($vitalsigns ?? '')->vs_2nd_time ? (\Carbon\Carbon::parse($vitalsigns['vs_2nd_time'])->format('H:i')) : '') }}">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="blood_pressure2">Blood Pressure (mmHg):</label>
                            <input type="text" class="form-control" name="blood_pressure2" placeholder="0/0" id="blood_pressure2">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="respiratory_rate2">Respiratory Rate (bpm):</label>
                            <input type="number" class="form-control" name="respiratory_rate2" placeholder="0" id="respiratory_rate2">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="pulse_rate2">Pulse Rate (bpm):</label>
                            <input type="number" class="form-control" name="pulse_rate2" placeholder="0" id="pulse_rate2">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="oxygen_sat2">Oxygen Saturation (SpO2%):</label>
                            <input type="number" class="form-control" name="oxygen_sat2" placeholder="0" id="oxygen_sat2">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="skin_color2">Skin Color:</label>
                            <input type="text" class="form-control" name="skin_color2" placeholder="Normal, Pale, Flushed, Bluish" id="skin_color2">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="skin_temp2">Skin Temperature:</label>
                            <input type="text" class="form-control" name="skin_temp2" placeholder="Normal, Hot, Cold" id="skin_temp2">
                        </div>
                    </div>

                </div> <!-- close align-items-center div -->


                <hr class="solid-line my-4"> <!-- Add a horizontal line with custom class -->

                <label style="font-size: larger; font-weight: bold;">3rd:</label>

                <div class="row align-items-center"> <!-- Add align-items-center class here -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="vs_3rd_time">Time:</label>
                            <input type="time" class="form-control" name="vs_3rd_time" value="{{ old('vs_3rd_time', optional($vitalsigns ?? '')->vs_3rd_time ? (\Carbon\Carbon::parse($vitalsigns['vs_3rd_time'])->format('H:i')) : '') }}">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="blood_pressure3">Blood Pressure (mmHg):</label>
                            <input type="text" class="form-control" name="blood_pressure3" placeholder="0/0" id="blood_pressure3">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="respiratory_rate3">Respiratory Rate (bpm):</label>
                            <input type="number" class="form-control" name="respiratory_rate3" placeholder="0" id="respiratory_rate3">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="pulse_rate3">Pulse Rate (bpm):</label>
                            <input type="number" class="form-control" name="pulse_rate3" placeholder="0" id="pulse_rate3">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="oxygen_sat3">Oxygen Saturation (SpO2%):</label>
                            <input type="number" class="form-control" name="oxygen_sat3" placeholder="0" id="oxygen_sat3">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="skin_color3">Skin Color:</label>
                            <input type="text" class="form-control" name="skin_color3" placeholder="Normal, Pale, Flushed, Bluish" id="skin_color3">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="skin_temp3">Skin Temperature:</label>
                            <input type="text" class="form-control" name="skin_temp3" placeholder="Normal, Hot, Cold" id="skin_temp3">
                        </div>
                    </div>

                </div> <!-- close align-items-center div -->


                <hr class="solid-line my-4"> <!-- Add a horizontal line with custom class -->

                <label style="font-size: larger; font-weight: bold;">4th:</label>

                <div class="row align-items-center"> <!-- Add align-items-center class here -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="vs_4th_time">Time:</label>
                            <input type="time" class="form-control" name="vs_4th_time" value="{{ old('vs_4th_time', optional($vitalsigns ?? '')->vs_4th_time ? (\Carbon\Carbon::parse($vitalsigns['vs_4th_time'])->format('H:i')) : '') }}">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="blood_pressure4">Blood Pressure (mmHg):</label>
                            <input type="text" class="form-control" name="blood_pressure4" placeholder="0/0" id="blood_pressure4">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="respiratory_rate4">Respiratory Rate (bpm):</label>
                            <input type="number" class="form-control" name="respiratory_rate4" placeholder="0" id="respiratory_rate4">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="pulse_rate4">Pulse Rate (bpm):</label>
                            <input type="number" class="form-control" name="pulse_rate4" placeholder="0" id="pulse_rate4">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="oxygen_sat4">Oxygen Saturation (SpO2%):</label>
                            <input type="number" class="form-control" name="oxygen_sat4" placeholder="0" id="oxygen_sat4">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="skin_color4">Skin Color:</label>
                            <input type="text" class="form-control" name="skin_color4" placeholder="Normal, Pale, Flushed, Bluish" id="skin_color4">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="skin_temp4">Skin Temperature:</label>
                            <input type="text" class="form-control" name="skin_temp4" placeholder="Normal, Hot, Cold" id="skin_temp4">
                        </div>
                    </div>

                </div> <!-- close align-items-center div -->


            </div>
        </div>


        <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-chevron-right" aria-hidden="true"></i></button>
    </form>


  </div>
</div>
</div>

<script>
    const ventilationSelect = document.getElementById('ventilation');
    const othersText = document.getElementById('othersText'); 
    const otherVentilationInput = document.getElementById('other_ventilation');
        function toggleFields() {
            const selectedValue = ventilationSelect.value; 
            if (selectedValue === 'Others') {
                othersText.style.display = 'block';
                otherVentilationInput.required = true;
            } else {
                othersText.style.display = 'none';
                otherVentilationInput.required = false;
            }
        }
        toggleFields(); // Initial toggle based on selected outcome
        ventilationSelect.addEventListener('change', toggleFields);
    document.addEventListener("DOMContentLoaded", function () {
    const aedAppliedYes = document.getElementById("aed_applied_yes");
    const aedAppliedNo = document.getElementById("aed_applied_no");
    const aedAppliedDT = document.getElementById("aed_applied_dt_div");
    const pacemakerOnYes = document.getElementById("pacemaker_on_yes");
    const pacemakerOnNo = document.getElementById("pacemaker_on_no");
    const pacemakerOnDT = document.getElementById("pacemaker_on_dt_div");
    aedAppliedNo.addEventListener("change", function () {
        setLocalStorageItem(aedAppliedNo.id, aedAppliedNo.checked);
        aedAppliedDT.style.display = aedAppliedNo.checked ? "none" : "block";
    });
    aedAppliedYes.addEventListener("change", function () {
        setLocalStorageItem(aedAppliedYes.id, aedAppliedYes.checked);
        aedAppliedDT.style.display = aedAppliedYes.checked ? "block" : "none";
    });
    pacemakerOnYes.addEventListener("change", function () {
        setLocalStorageItem(pacemakerOnYes.id, pacemakerOnYes.checked);
        pacemakerOnDT.style.display = pacemakerOnYes.checked ? "block" : "none";
    });
    pacemakerOnNo.addEventListener("change", function () {
        setLocalStorageItem(pacemakerOnNo.id, pacemakerOnNo.checked);
        pacemakerOnDT.style.display = pacemakerOnNo.checked ? "none" : "block";
    });
    function setLocalStorageItem(item, value) {
    localStorage.setItem(item, value);
}
    function getLocalStorageItem(item) {
        return item;
    }
    function handleCheckboxState(checkbox, explanationBox) {
        const isChecked = getLocalStorageItem(checkbox.id);
         if ( checkbox.checked === true) {    
            explanationBox.style.display = "block";
        } else {
            explanationBox.style.display = "none";
        }
        console.log(`explanationBox.style.display: ${explanationBox.style.display}`);
    }
    handleCheckboxState(aedAppliedYes, aedAppliedDT);
    handleCheckboxState(pacemakerOnYes, pacemakerOnDT);
});
</script>
@endsection