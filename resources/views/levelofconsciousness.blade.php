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
    <a class="btn btn-secondary" >Pre-Hospital Care Report</a>
    <a class="btn btn-secondary" style="color: #fff; background-color: #6c757d">Level of Consciousness</a>
    <a class="btn btn-secondary" >Sample History</a>
    <a class="btn btn-secondary" >Vital Signs</a>
    <a class="btn btn-secondary" >Head To Toe Assessment</a>
    <a class="btn btn-secondary" >Receiving Medical Facility Information</a>
</div>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
    
    <!-- may form dito for submit -->
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

                <div class="col-md-6">
                    <div class="form-group" style="margin-top: 30px;">
                        <div id="loc_baseline_checkbox">
                            <input type="checkbox" id="alert-checkbox1" name="loc_baseline_checkbox[]" value="Alert" {{ in_array('Alert', $LOCBaseline ?? []) ? 'checked' : '' }}>
                            <label for="alert-checkbox1" style="margin-right: 10px;">Alert</label>

                            <input type="checkbox" id="verbal-checkbox1" name="loc_baseline_checkbox[]" value="Verbal" {{ in_array('Verbal', $LOCBaseline ?? []) ? 'checked' : '' }}>
                            <label for="verbal-checkbox1" style="margin-right: 10px;">Verbal</label>

                            <input type="checkbox" id="pain-checkbox1" name="loc_baseline_checkbox[]" value="Pain" {{ in_array('Pain', $LOCBaseline ?? []) ? 'checked' : '' }}>
                            <label for="pain-checkbox1" style="margin-right: 10px;">Pain</label> 

                            <input type="checkbox" id="unresponsive-checkbox1" name="loc_baseline_checkbox[]" value="Unresponsive" {{ in_array('Unresponsive', $LOCBaseline ?? []) ? 'checked' : '' }}>
                            <label for="unresponsive-checkbox1" style="margin-right: 10px;">Unresponsive</label>
                        </div>
                    </div>
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

                <div class="col-md-6">
                    <div class="form-group" style="margin-top: 30px;">
                        <div id="loc_2nd_checkbox">
                            <input type="checkbox" id="alert-checkbox2" name="loc_2nd_checkbox[]" value="Alert" {{ in_array('Alert', $LOCBaseline ?? []) ? 'checked' : '' }}>
                            <label for="alert-checkbox2" style="margin-right: 10px;">Alert</label>

                            <input type="checkbox" id="verbal-checkbox2" name="loc_2nd_checkbox[]" value="Verbal" {{ in_array('Verbal', $LOCBaseline ?? []) ? 'checked' : '' }}>
                            <label for="verbal-checkbox2" style="margin-right: 10px;">Verbal</label>

                            <input type="checkbox" id="pain-checkbox2" name="loc_2nd_checkbox[]" value="Pain" {{ in_array('Pain', $LOCBaseline ?? []) ? 'checked' : '' }}>
                            <label for="pain-checkbox2" style="margin-right: 10px;">Pain</label> 

                            <input type="checkbox" id="unresponsive-checkbox2" name="loc_2nd_checkbox[]" value="Unresponsive" {{ in_array('Unresponsive', $LOCBaseline ?? []) ? 'checked' : '' }}>
                            <label for="unresponsive-checkbox2" style="margin-right: 10px;">Unresponsive</label>
                        </div>
                    </div>
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

                <div class="col-md-6">
                    <div class="form-group" style="margin-top: 30px;">
                        <div id="loc_3rd_checkbox">
                            <input type="checkbox" id="alert-checkbox3" name="loc_3rd_checkbox[]" value="Alert" {{ in_array('Alert', $LOCBaseline ?? []) ? 'checked' : '' }}>
                            <label for="alert-checkbox3" style="margin-right: 10px;">Alert</label>

                            <input type="checkbox" id="verbal-checkbox3" name="loc_3rd_checkbox[]" value="Verbal" {{ in_array('Verbal', $LOCBaseline ?? []) ? 'checked' : '' }}>
                            <label for="verbal-checkbox3" style="margin-right: 10px;">Verbal</label>

                            <input type="checkbox" id="pain-checkbox3" name="loc_3rd_checkbox[]" value="Pain" {{ in_array('Pain', $LOCBaseline ?? []) ? 'checked' : '' }}>
                            <label for="pain-checkbox3" style="margin-right: 10px;">Pain</label> 

                            <input type="checkbox" id="unresponsive-checkbox3" name="loc_3rd_checkbox[]" value="Unresponsive" {{ in_array('Unresponsive', $LOCBaseline ?? []) ? 'checked' : '' }}>
                            <label for="unresponsive-checkbox3" style="margin-right: 10px;">Unresponsive</label>
                        </div>
                    </div>
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

                <div class="col-md-6">
                    <div class="form-group" style="margin-top: 30px;">
                        <div id="loc_4th_checkbox">
                            <input type="checkbox" id="alert-checkbox4" name="loc_4th_checkbox[]" value="Alert" {{ in_array('Alert', $LOCBaseline ?? []) ? 'checked' : '' }}>
                            <label for="alert-checkbox4" style="margin-right: 10px;">Alert</label>

                            <input type="checkbox" id="verbal-checkbox4" name="loc_4th_checkbox[]" value="Verbal" {{ in_array('Verbal', $LOCBaseline ?? []) ? 'checked' : '' }}>
                            <label for="verbal-checkbox4" style="margin-right: 10px;">Verbal</label>

                            <input type="checkbox" id="pain-checkbox4" name="loc_4th_checkbox[]" value="Pain" {{ in_array('Pain', $LOCBaseline ?? []) ? 'checked' : '' }}>
                            <label for="pain-checkbox4" style="margin-right: 10px;">Pain</label> 

                            <input type="checkbox" id="unresponsive-checkbox4" name="loc_4th_checkbox[]" value="Unresponsive" {{ in_array('Unresponsive', $LOCBaseline ?? []) ? 'checked' : '' }}>
                            <label for="unresponsive-checkbox4" style="margin-right: 10px;">Unresponsive</label>
                        </div>
                    </div>
                </div>
            </div> <!-- close align-items-center div -->

        </div>
    </div>



        <form action="{{ url('/store_levelofconsciousness') }}" method="post">
            @csrf 
            <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-chevron-right" aria-hidden="true"></i></button>
        </form>
<!-- </form>  -->

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