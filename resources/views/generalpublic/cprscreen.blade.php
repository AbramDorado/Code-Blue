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
</style>
    <span>Cycle:</span>
    <div id="cycles">1</div>
    <div id="timer">0</div>
<script>

let timerElement = document.getElementById("timer");
let timerCurrentValue = parseInt(timerElement.innerText);
let cycleElement = document.getElementById("cycles");
let cycleCurrentValue = parseInt(cycleElement.innerText);

function incrementTimer() {
    timerCurrentValue++;
    timerElement.innerText = timerCurrentValue;
    if (timerCurrentValue === 30){
        cycleCurrentValue++;
        cycleElement.innerText = cycleCurrentValue
        timerCurrentValue = 0
    }
}

setInterval(incrementTimer, 1000);


</script>
</body>
</html>
