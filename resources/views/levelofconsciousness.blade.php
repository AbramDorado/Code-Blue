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
          <h1 class="display-4">Level of Consciousness</h1>
          <p class="lead">Level of Consciousness</p>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="fixed-header">
    <a class="btn btn-secondary" href="{{ route('prehospital') }}" >Pre-Hospital Care Report</a>
    <a class="btn btn-secondary" style="color: #fff; background-color: #6c757d" >Level of Consciousness</a>
    <a class="btn btn-secondary" href="{{ route('samplehistory') }}" >Sample History</a>
    <a class="btn btn-secondary" href="{{ route('vitalsigns') }}" >Vital Signs</a>
    <a class="btn btn-secondary" href="{{ route('htassessment') }}" >Head To Toe Assesment</a>
    <a class="btn btn-secondary" href="{{ route('rmfinformation') }}" >Receiving Medical Facility Information</a>
</div>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">

    <form method="POST" action="{{ route('store_levelofconsciousness') }}"> <!--start of the form submittion-->
        @csrf

        <div class="card">
            <div class="card-header bg-secondary text-white py-2">Level Of Consciousness</div>
            <div class="card-body">
                <label style="font-size: larger; font-weight: bold;">Baseline:</label>
                <div class="row align-items-center"> <!-- Add align-items-center class here -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="loc_baseline_time">Time:</label>
                            <input type="time" class="form-control" name="loc_baseline_time" value="{{ old('loc_baseline_time', optional($levelofconsciousness ?? '')->loc_baseline_time ? (\Carbon\Carbon::parse($levelofconsciousness['loc_baseline_time'])->format('H:i')) : '') }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="status_baseline">Status:</label>
                        <input type="text" class="form-control" name="status_baseline" placeholder="Alert/Verbal/Pain/Unresponsive" value="{{ old('status_baseline', optional($patient ?? '')->status_baseline) }}">
                    </div>

                </div> <!-- close align-items-center div -->

                <label style="font-size: larger; font-weight: bold;">2nd:</label>
                <div class="row align-items-center"> <!-- Add align-items-center class here -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="loc_2nd_time">Time:</label>
                            <input type="time" class="form-control" name="loc_2nd_time" value="{{ old('loc_2nd_time', optional($levelofconsciousness ?? '')->loc_2nd_time ? (\Carbon\Carbon::parse($levelofconsciousness['loc_2nd_time'])->format('H:i')) : '') }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="status2">Status:</label>
                        <input type="text" class="form-control" name="status2" placeholder="Alert/Verbal/Pain/Unresponsive" value="{{ old('status2', optional($patient ?? '')->status2) }}">
                    </div>
                </div> <!-- close align-items-center div -->

                <label style="font-size: larger; font-weight: bold;">3rd:</label>
                <div class="row align-items-center"> <!-- Add align-items-center class here -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="loc_3rd_time">Time:</label>
                            <input type="time" class="form-control" name="loc_3rd_time" value="{{ old('loc_3rd_time', optional($levelofconsciousness ?? '')->loc_3rd_time ? (\Carbon\Carbon::parse($levelofconsciousness['loc_3rd_time'])->format('H:i')) : '') }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="status3">Status:</label>
                        <input type="text" class="form-control" name="status3" placeholder="Alert/Verbal/Pain/Unresponsive" value="{{ old('status3', optional($patient ?? '')->status3) }}">
                    </div>
                </div> <!-- close align-items-center div -->

                <label style="font-size: larger; font-weight: bold;">4th:</label>
                <div class="row align-items-center"> <!-- Add align-items-center class here -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="loc_4th_time">Time:</label>
                            <input type="time" class="form-control" name="loc_4th_time" value="{{ old('loc_4th_time', optional($levelofconsciousness ?? '')->loc_4th_time ? (\Carbon\Carbon::parse($levelofconsciousness['loc_4th_time'])->format('H:i')) : '') }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="status4">Status:</label>
                        <input type="text" class="form-control" name="status4" placeholder="Alert/Verbal/Pain/Unresponsive" value="{{ old('status4', optional($patient ?? '')->status4) }}">
                    </div>
                </div> <!-- close align-items-center div -->

            </div>
        </div>



            
        <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-chevron-right" aria-hidden="true"></i></button>
    </form> <!--end of the form submission--> 
     

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