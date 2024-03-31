<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<style>
    body {
        background-color: #f5f5f5;
        font-family: Arial, sans-serif;
    }

    .generalpublic-button-startcpr {
        background-color: #28a745;
        color: white;
        border: none;
        border-radius: 10px;
        padding: 10px 20px;
        cursor: pointer;
    }

</style>

    <span>Cycle:</span>
    <div id="cycles">1</div>

    <div id=chestCompression style="display:block;">
        <span>Compressions:</span>
        <div id="timer">1</div>
    </div>

    <div id ="breathe" style="display:none;">
        <span>Breathe:</span>
        <div id="breathTimer">0</div>
    </div>

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


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

let timerElement = document.getElementById("timer");
let timerCurrentValue = parseInt(timerElement.innerText);
let cycleElement = document.getElementById("cycles");
let cycleCurrentValue = parseInt(cycleElement.innerText);

function incrementTimer() {
    if ($("#chestCompression").is(":visible")) {
        timerCurrentValue++;
        timerElement.innerText = timerCurrentValue;

        if (timerCurrentValue === 6){
            timerCurrentValue = 0;
            timerElement.innerText = timerCurrentValue;
            $("#chestCompression").toggle();
            $("#breathe").toggle();
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
            breathCurrentValue = 0;
            breathElement.innerText = breathCurrentValue;
            $("#chestCompression").toggle();
            $("#breathe").toggle();
            incrementTimer();
            incrementCycle();
        }
    }
}

let intervalTimer= setInterval(incrementTimer, 1000);
let intervalBreathTimer = setInterval(incrementBreathTimer, 1000);
let isCPRPaused = false; 

function pauseCPR() {
    
    if (isCPRPaused) {
        intervalTimer = setInterval(incrementTimer, 1000);
        intervalBreathTimer = setInterval(incrementBreathTimer, 1000);

        document.querySelector(".pausecpr > span").innerText = "PAUSE CPR";
        isCPRPaused = false;
    } else {
        clearInterval(intervalTimer);
        clearInterval(intervalBreathTimer);

        document.querySelector(".pausecpr > span").innerText = "RESUME CPR";
        isCPRPaused = true;
    }
}

function resetCPR(){
    timerCurrentValue = 1;
    timerElement.innerText = timerCurrentValue;
    cycleCurrentValue = 1;
    cycleElement.innerText = cycleCurrentValue;
    breathCurrentValue = 0;
    breathElement.innerText = breathCurrentValue;
}

</script>
</body>
</html>
