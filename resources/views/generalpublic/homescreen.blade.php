<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <style>
        body {
            background-color: #EDF1F6 !important;
        }

        span{
            font-family: Helvetica !important;
            font-weight: bold  !important;
            font-size: x-large;
            color: #FFFFFF;
        }

        .rescuers, .victim{
            font-family: Helvetica  !important;
            font-weight: bold  !important;
            font-size: x-large  !important;
            color: #4D4D4D  !important;
        }

        .one, .two{
            font-size: 100px;
        }

        .adult, .child{
            font-size: 40px;
        }

        .generalpublic-container {
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .left-buttons,
        .right-buttons {
            justify-content: center;
            align-items: center;
        }

        .left-buttons button,
        .right-buttons button {
            background-color: #B9BABB;
            color: white;
            border: none;
            height: 150px;
            width: 150px;
            border-radius: 30px;
            margin: 5px;
            box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.5);
            cursor: pointer;
        }

        .left-buttons button.active,
        .right-buttons button.active {
            background-color: #525F69;
            box-shadow: none;
        }

        .button-startcpr {
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 20px;
            padding: 10px 20px;
            cursor: pointer;
        }

        .button-startcpr:hover {
            background-color: #218838;
        }

        .button-startcpr:disabled {
            background-color: #ABBFB6; 
            cursor: not-allowed; 
        }
    </style>
</head>
<body>
@extends('layouts.gpublicmaster')
<br>
<div class="generalpublic-container container">
    <div class="row" style="margin-top: 100px;">
        <div class="col">
            <div class="d-flex justify-content-center align-items-center" style="height: 100%">
                <span class="rescuers">NO. OF RESCUERS</span>
            </div>
            
        </div>
        <div class="col">
            <div class="d-flex justify-content-center align-items-center" style="height: 100%">
                <span class="victim">VICTIM</span>
            </div>
        </div>
    </div>
    <div class="row" style="margin-top: 30px;">
        <div class="col">
            <div class="d-flex justify-content-center align-items-center" style="height: 100%">
                <div class="left-buttons">
                    <button class="button-1 button" data-rescuers="one">
                        <span class="one" >1</span>
                    </button>
                    <button class="button-2 button" data-rescuers="two">
                        <span class="two"  >2</span>
                    </button>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="d-flex justify-content-center align-items-center" style="height: 100%">
                <div class="right-buttons">
                    <button class="button-adult button" data-victim="adult">
                        <span class="adult">ADULT</span>
                    </button>
                    <button class="button-child button" data-victim="child">
                        <span class="child">CHILD</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="row" style="margin-top: 30px;">
        <div class="d-flex justify-content-center align-items-center" style="height: 100%">
            <button class="button-startcpr" id="startCPRButton" onclick="startCPR()" disabled>
                <span class="startcpr">START CPR</span>
            </button>
        </div>
    </div>

    <br><br><br>

    <div class="form-group row m-t-20">
        <div class="col-12 text-center">
            <a href="{{route('hotlines')}}" style="font-family: Helvetica; font-weight: bold; font-size: large; color: #4D4D4D;">EMERGENCY HOTLINES</a>
        </div>
    </div>

    <div class="form-group row m-t-20">
        <div class="col-12 text-center">
            <a href="{{route('howtocpr')}}" style="font-family: Helvetica; font-weight: bold; font-size: large; color: #4D4D4D;">HOW TO PERFORM CPR</a>
        </div>
    </div>
</div>

<script>
    const leftButtons = document.querySelectorAll(".left-buttons > button");
    const rightButtons = document.querySelectorAll(".right-buttons > button");
    const startCPRButton = document.getElementById("startCPRButton")
    let rescuersSelected = '';
    let victimSelected = '';

    leftButtons.forEach(button => {
        button.addEventListener('click', () => {
            leftButtons.forEach(button => button.classList.remove('active'));
            rescuersSelected = button.dataset.rescuers;
            enableCPR();
            button.classList.add('active');
        });
    });

    rightButtons.forEach(button => {
        button.addEventListener('click', () => {
            rightButtons.forEach(button => button.classList.remove('active'));
            victimSelected = button.dataset.victim;
            enableCPR();
            button.classList.add('active');
        });
    });

    function enableCPR(){
        if (rescuersSelected && victimSelected){
            startCPRButton.disabled = false;
        }
        else{
            startCPRButton.disabled = true;
        }
    }

    function startCPR() {
        if (rescuersSelected === 'one' && victimSelected === 'child') {
            window.location.href = "{{ route('onechild') }}";
        } else if (rescuersSelected === 'two' && victimSelected === 'adult') {
            window.location.href = "{{ route('twoadult') }}";
        } else if (rescuersSelected === 'one' && victimSelected === 'adult') {
            window.location.href = "{{ route('oneadult') }}";
        } else if (rescuersSelected === 'two' && victimSelected === 'child') {
            window.location.href = "{{ route('twochild') }}";
        } else {
            alert("Select # of rescuers and type of victim")
        }
    }


</script>
</body>
</html>
