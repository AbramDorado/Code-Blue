<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
<style>
    body {
        background-color: #EDF1F6;
        font-family: Helvetica;
    }

    .container{
        display: flex;
        flex-direction: column;
        justify-content: center; 
        align-items: center; 
        height: 100vh;
    }

    .button-pausecpr, .button-resetcpr {
        
        color: white;
        border: none;
        border-radius: 10px;
        padding: 10px 20px;
        cursor: pointer;
    }

    .button-pausecpr{
        background-color: #F8A605;
    }

    .button-resetcpr{
        background-color: #4D4D4D;
    }

    .main-container {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    #timer, #breathTimer{
        font-size: 200px;
        font-weight: bold;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
    
    #cycles{
        font-size: 80px;
        font-weight: bold;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .main{
        font-size: 30px;
        font-weight: bold;
    }

    #spanCycle{
        font-size: 20px;
        font-weight: bold;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }


</style>

<div class="container">
    <div class="row">
        <span id="spanCycle">CYCLE</span>
        <div id="cycles">1</div>

    </div>

    <div class = "row">
        <div class="main-container">
            <div id=chestCompression style="display:block;">
                <span class="main">COMPRESSIONS</span>
                <div id="timer">1</div>
            </div>

            <div id ="breathe" style="display:none;">
                <span class="main">BREATHE</span>
                <div id="breathTimer">1</div>
            </div>
        <div>
    </div>

    <div class="">
        <button class="button-pausecpr" onclick="pauseCPR()">
            <span class="pausecpr">
                <span>PAUSE CPR</span>
            </span>
        </button>

        <button class="button-resetcpr" onclick="resetCPR()">
            <span class="resetcpr">
                <span>RESET CPR</span>
            </span>
        </button>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<audio id="beatingSound" src="/audio/beat.mp3" preload="auto"></audio>
<script>

let timerElement = document.getElementById("timer");
let timerCurrentValue = parseInt(timerElement.innerText);
let cycleElement = document.getElementById("cycles");
let cycleCurrentValue = parseInt(cycleElement.innerText);

function incrementTimer() {
    if ($("#chestCompression").is(":visible")) {
        timerCurrentValue++;
        timerElement.innerText = timerCurrentValue;
        document.getElementById('beatingSound').play();
        console.log(document.getElementById('beatingSound').src);


        if (timerCurrentValue === 31){
            $("#chestCompression").toggle();
            $("#breathe").toggle();
            timerCurrentValue = 1;
            timerElement.innerText = timerCurrentValue;
        }
    }
}

function incrementCycle(){
    cycleCurrentValue++;
    cycleElement.innerText = cycleCurrentValue;
}

function incrementBreathTimer(){
    let breathElement = document.getElementById("breathTimer");
    let breathCurrentValue = parseInt(breathElement.innerText);

    if ($("#breathe").is(":visible")) {
        breathCurrentValue++;
        breathElement.innerText = breathCurrentValue;

        if (breathCurrentValue === 3){
            $("#chestCompression").toggle();
            $("#breathe").toggle();
            incrementTimer();
            incrementCycle();
            breathCurrentValue = 1;
            breathElement.innerText = breathCurrentValue;
        }
    }
}

let intervalTimer= setInterval(incrementTimer, 550);
let intervalBreathTimer = setInterval(incrementBreathTimer, 2000);
let isCPRPaused = false; 

function pauseCPR() {
    const button = document.querySelector(".button-pausecpr");
    
    if (isCPRPaused) {
        intervalTimer = setInterval(incrementTimer, 550);
        intervalBreathTimer = setInterval(incrementBreathTimer, 2000);

        button.style.backgroundColor = "#F8A605"; 
        document.querySelector(".pausecpr > span").innerText = "PAUSE CPR";
        isCPRPaused = false;
    } else {
        clearInterval(intervalTimer);
        clearInterval(intervalBreathTimer);

        button.style.backgroundColor = "#28a745"; 
        document.querySelector(".pausecpr > span").innerText = "RESUME CPR";
       
        isCPRPaused = true;
    }
}

function resetCPR(){
    timerCurrentValue = 1;
    timerElement.innerText = timerCurrentValue;
    cycleCurrentValue = 1;
    cycleElement.innerText = cycleCurrentValue;
    breathCurrentValue = 1;
    breathElement.innerText = breathCurrentValue;
}

</script>
</body>
</html>
