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
          <h1 class="display-4">Sample History</h1>
          <p class="lead">Sample History</p>
        </div>
      </div>
    </div>
  </div>
</div>
            
<div class="fixed-header">
    <a class="btn btn-secondary" href="{{ route('prehospital') }}">Pre-Hospital Care Report</a>
    <a id="initialResuscitationBtn" class="btn btn-secondary" >Level of Consciousness</a>
    <a class="btn btn-secondary" style="color: #fff; background-color: #6c757d" >Sample History</a>
    <!-- Add additional buttons below -->
    <a id="outcomeBtn" class="btn btn-secondary" >Vital Signs</a>
    <a id="evaluationBtn" class="btn btn-secondary" >Head To Toe Assesment</a>
    <a id="codeteamBtn" class="btn btn-secondary" >Receiving Medical Facility Information</a>
    <!-- Add more buttons if needed -->
</div>




<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">


    <form method="POST" action="{{ route('store_samplehistory') }}"> <!--start of the form submittion-->
        @csrf


        <div class="card">
            <div class="card-header bg-secondary text-white py-2">Sample History</div>
            <div class="card-body">

                            <div id="medical-info">
                                <div class="form-group">
                                    <label for="signs_symptoms">Signs and Symptoms:</label>
                                    <input type="text" class="form-control" name="signs_symptoms" placeholder="Signs and Symptoms" value="{{ old('signs_symptoms', optional($samplehistory ?? '')->signs_symptoms) }}">
                                </div>

                                <div class="form-group">
                                    <label for="allergies">Allergy:</label>
                                    <input type="text" class="form-control" name="allergies" placeholder="Allergy" value="{{ old('allergies', optional($samplehistory ?? '')->allergies) }}">
                                </div>

                                <div class="form-group">
                                    <label for="medications">Medication:</label>
                                    <input type="text" class="form-control" name="medications" placeholder="Medication" value="{{ old('medications', optional($samplehistory ?? '')->medications) }}">
                                </div>

                                <div class="form-group">
                                    <label for="past_medical_history">Past Medical History</label>
                                    <input type="text" class="form-control" name="past_medical_history" placeholder="Past Medical History" value="{{ old('past_medical_history', optional($samplehistory ?? '')->past_medical_history) }}">
                                </div>

                                <div class="form-group">
                                    <label for="last_oral_intake">Last oral intake</label>
                                    <input type="text" class="form-control" name="last_oral_intake" placeholder="Last oral intake" value="{{ old('last_oral_intake', optional($samplehistory ?? '')->last_oral_intake) }}">
                                </div>

                                <div class="form-group">
                                    <label for="event_leading_to_injury">Event leading to injury</label>
                                    <input type="text" class="form-control" name="event_leading_to_injury" placeholder="Event leading to injury" value="{{ old('event_leading_to_injury', optional($samplehistory ?? '')->event_leading_to_injury) }}">
                                </div>
                            </div>

                            <!-- <button type="submit" class="btn btn-primary">Submit</button> -->
        

        <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-chevron-right" aria-hidden="true"></i></button> <!-- Added btn-block class for width -->
    </form> <!--end of the form submission-->

  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
        function addMedicalField(fieldName) {
            var container = document.getElementById('medical-info');
            var field = document.createElement('div');
            field.classList.add('form-group');

            var input = document.createElement('input');
            input.type = 'text';
            input.name = fieldName + '[]'; // Change the name attribute based on the field
            input.classList.add('form-control');

            var deleteBtn = document.createElement('button');
            deleteBtn.type = 'button';
            deleteBtn.classList.add('btn', 'btn-danger', 'btn-sm', 'mt-2');
            deleteBtn.textContent = 'X';
            deleteBtn.onclick = function() {
                container.removeChild(field);
            };

            field.appendChild(input);
            field.appendChild(deleteBtn);
            container.appendChild(field);
        }
    </script>

@endsection