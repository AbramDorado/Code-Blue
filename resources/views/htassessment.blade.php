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
          <h1 class="display-4">Head To Toe Assessment</h1>
          <p class="lead">Head To Toe Assessment</p>
        </div>
      </div>
    </div>
  </div>
</div>
            
<div class="fixed-header">
    <a class="btn btn-secondary" >Pre-Hospital Care Report</a>
    <a class="btn btn-secondary" >Level of Consciousness</a>
    <a class="btn btn-secondary" >Sample History</a>
    <a class="btn btn-secondary" >Vital Signs</a>
    <a class="btn btn-secondary" style="color: #fff; background-color: #6c757d">Head To Toe Assessment</a>
    <a class="btn btn-secondary" >Receiving Medical Facility Information</a>
</div>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
    
    <!-- may form dito for submit -->
    @csrf
    <div class="card">
        <div class="card-header bg-secondary text-white py-2">Head To Toe Assessment</div>
        <div class="card-body">

            <div class="form-group">
                <label for="head">Head:</label>
                <textarea class="form-control" name="head">{{ old('head', optional($htassessment ?? '')->head ?? '') }}</textarea>
            </div>

            <div class="form-group">
                <label for="shoulders">Shoulders:</label>
                <textarea class="form-control" name="shoulders">{{ old('shoulders', optional($htassessment ?? '')->shoulders ?? '') }}</textarea>
            </div>

            <div class="form-group">
                <label for="arms">Arms:</label>
                <textarea class="form-control" name="arms">{{ old('arms', optional($htassessment ?? '')->arms ?? '') }}</textarea>
            </div>

            <div class="form-group">
                <label for="body">Body:</label>
                <textarea class="form-control" name="body">{{ old('body', optional($htassessment ?? '')->body ?? '') }}</textarea>
            </div>
            
            <div class="form-group">
                <label for="legs">Legs:</label>
                <textarea class="form-control" name="legs">{{ old('legs', optional($htassessment ?? '')->legs ?? '') }}</textarea>
            </div>

            <div class="form-group">
                <label for="toes">Toes:</label>
                <textarea class="form-control" name="toes">{{ old('toes', optional($htassessment ?? '')->toes ?? '') }}</textarea>
            </div>

        </div>
    </div>


        <form action="{{ url('/store_htassessment') }}" method="post">
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