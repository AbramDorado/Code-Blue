<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <style>
        body {
            background-color: #EDF1F6 !important; 
            font-family: Helvetica;
        }

        .content {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            font-size: 18px;
        }

        .info-container h2 {
            font-family: Helvetica !important; 
            font-weight: bold;
            font-size: x-large;
            color: #4D4D4D;
        }

        .info-container p {
            font-family: Helvetica !important;
        }

        .w3-sidebar {
            width: 200px;
            background-color: white;
            position: fixed;
            height: 100%;
            overflow: auto;
            font-family: Helvetica !important;
        }

        .w3-sidebar a {
            display: block;
            color: black;
            padding: 16px;
            text-decoration: none;
        }

        .w3-sidebar a.active {
            background-color: #04AA6D;
            color: white;
        }

        .w3-sidebar a:hover:not(.active) {
            background-color: #555;
            color: white;
        }

        @media screen and (max-width: 700px) {
            .w3-sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }
            .w3-sidebar a {
                float: left;
            }
            .content {
                margin-left: 0;
            }
        }

        @media screen and (max-width: 400px) {
            .w3-sidebar a {
                text-align: center;
                float: none;
            }
        }
    </style>
</head>
<body>
@include('layouts.gpublicmaster')
<br><br><br>
<div class="w3-sidebar w3-bar-block">
    <div class="w3-container w3-dark-grey">
        <h2 style="font-family: Helvetica; font-size: 27px">How to CPR</h2>
    </div>
    <div class="w3-dropdown-hover">
        <button class="w3-button" onclick="showContent('one-rescuer')">One rescuer<i class="fa fa-caret-down"></i></button>
        <div class="w3-dropdown-content w3-bar-block">
            <a href="#" class="w3-bar-item w3-button" onclick="showInfo('one-adult')">Adult</a>
            <a href="#" class="w3-bar-item w3-button" onclick="showInfo('one-child')">Child</a>
        </div>
    </div>

    <div class="w3-dropdown-hover">
        <button class="w3-button" onclick="showContent('two-rescuer')">Two rescuers<i class="fa fa-caret-down"></i></button>
        <div class="w3-dropdown-content w3-bar-block">
            <a href="#" class="w3-bar-item w3-button" onclick="showInfo('two-adult')">Adult</a>
            <a href="#" class="w3-bar-item w3-button" onclick="showInfo('two-child')">Child</a>
        </div>
    </div>
</div>

<div class="content">
    <div id="home-content" class="info-container" style="display: none;">
        <h2>Please select an option from the sidebar.</h2>
    </div>
    <div id="one-adult" class="info-container" style="display: none;">
        <h2>One Rescuer CPR - Adult</h2>
        <ol>
            <li>Survey the scene to see if it’s safe to do CPR. </li>
            <li>Check victim’s unresponsiveness. If unresponsive, roll victim on his/her back.</li>
            <li>Call for help; activate the emergency medical services; call for an ambulance/doctor.</li>
            <li>Give 30 chest compressions
                <ul>
                    <li><strong>Compression Depth:</strong> at least 2-2.4 inches (5-6 centimeters) deep.</li>
                    <li><strong>Compression Rate:</strong> 100-120 compressions per minute.</li>
                    <li><strong>Hand Placement:</strong> Two hands centered on the chest.</li>
                </ul>
            </li>
            <li>Give 2 short breaths
                <ul>
                    <li>Open the airway to a past-neutral position using the head-tilt/chin-lift technique.</li>
                    <li>Pinch the nose shut, take a normal breath, and make a complete seal over the person’s mouth with your mouth.</li>
                    <li>Ensure each breath lasts about 1 second and makes the chest rise; allow air to exit before giving the next breath.</li>
                    <li><strong>Note:</strong> If the 1st breath does not cause the chest to rise, retilt the head and ensure a proper seal before giving the 2nd breath. If the 2nd breath does not make the chest rise, an object may be blocking the airway.</li>
                </ul>
            </li>
            <li>Continue until help arrives, an automated external defibrillator (AED) is available or the emergency personnel arrives, or the victim is revived back to life.</li>
        </ol>
        
    </div>
    <div id="one-child" class="info-container" style="display: none;">
        <h2>One Rescuer CPR - Child</h2>
        <ol>
            <li>Survey the scene to see if it’s safe to do CPR.</li>
            <li>Check victim’s unresponsiveness. If unresponsive, roll victim on his/her back.</li>
            <li>Call for help; activate the emergency medical services; call for an ambulance/doctor.</li>
            <li>
                Give 30 chest compressions
                <ul>
                    <li>Compression Depth: 1/3 of the chest diameter, about 2 inches.</li>
                    <li>Compression Rate: 100-120 compressions per minute.</li>
                    <li>
                        Hand Placement:
                        <ul>
                            <li>Children: One hand in the center of the chest, with the other hand on top, fingers interlaced and clear of the chest.</li>
                            <li>Small Children: Place the heel of one hand in the center of the chest.</li>
                            <li>Infants: Use two fingers on the lower half of the breastbone.</li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li>
                Give 2 short breaths
                <ul>
                    <li>Children: Open the airway to a slightly past-neutral position using the head-tilt/chin-lift technique.</li>
                    <li>Babies: Open the airway to a neutral position using the head-tilt/chin-lift technique.</li>
                    <li>Pinch the nose shut, take a normal breath, and make a complete seal over the person’s mouth with your mouth.</li>
                    <li>Ensure each breath lasts about 1 second and makes the chest rise; allow air to exit before giving the next breath.</li>
                    <li>
                        Note: If the 1st breath does not cause the chest to rise, retilt the head and ensure a proper seal before giving the 2nd breath. If the 2nd breath does not make the chest rise, an object may be blocking the airway.
                    </li>
                </ul>
            </li>
            <li>Continue until help arrives, an automated external defibrillator (AED) is available or the emergency personnel arrives, or the victim is revived back to life.</li>
        </ol>
    </div>
    <div id="two-adult" class="info-container" style="display: none;">
        <h2>Two Rescuers CPR - Adult</h2>
        <ol>
            <li>Survey the scene to see if it’s safe to do CPR.</li>
            <li>Check victim’s unresponsiveness. If unresponsive, roll victim on his/her back.</li>
            <li>Call for help; activate the emergency medical services; call for an ambulance/doctor.</li>
            <li>
                1st rescuer gives 30 chest compressions
                <ul>
                    <li>Compression Depth: at least 2-2.4 inches (5-6 centimeters) deep.</li>
                    <li>Compression Rate: 100-120 compressions per minute.</li>
                    <li>Hand Placement: Two hands centered on the chest.</li>
                </ul>
            </li>
            <li>
                2nd rescuer gives 2 short breaths
                <ul>
                    <li>Open the airway to a past-neutral position using the head-tilt/chin-lift technique.</li>
                    <li>Pinch the nose shut, take a normal breath, and make a complete seal over the person’s mouth with your mouth.</li>
                    <li>Ensure each breath lasts about 1 second and makes the chest rise; allow air to exit before giving the next breath.</li>
                    <li>
                        Note: If the 1st breath does not cause the chest to rise, retilt the head and ensure a proper seal before giving the 2nd breath. If the 2nd breath does not make the chest rise, an object may be blocking the airway.
                    </li>
                </ul>
            </li>
            <li>Roles are exchanged every 5 cycles.</li>
            <li>Continue until help arrives, an automated external defibrillator (AED) is available or the emergency personnel arrives, or the victim is revived back to life.</li>
        </ol>
    </div>
    <div id="two-child" class="info-container" style="display: none;">
        <h2>Two Rescuers CPR - Child</h2>
        <ol>
            <li>Survey the scene to see if it’s safe to do CPR.</li>
            <li>Check victim’s unresponsiveness. If unresponsive, roll victim on his/her back.</li>
            <li>Call for help; activate the emergency medical services; call for an ambulance/doctor.</li>
            <li>
                1st rescuer gives 15 chest compressions
                <ul>
                    <li>Compression Depth: 1/3 of the chest diameter, about 2 inches.</li>
                    <li>Compression Rate: 100-120 compressions per minute.</li>
                    <li>
                        Hand Placement:
                        <ul>
                            <li>Children: One hand in the center of the chest, with the other hand on top, fingers interlaced and clear of the chest.</li>
                            <li>Small Children: Place the heel of one hand in the center of the chest.</li>
                            <li>Infants: Use two fingers on the lower half of the breastbone.</li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li>
                2nd rescuer gives 2 short breaths
                <ul>
                    <li>
                        Open the airway to a slightly past-neutral position using the head-tilt/chin-lift technique.
                        <ul>
                            <li>Children: Open the airway to a slightly past-neutral position using the head-tilt/chin-lift technique.</li>
                            <li>Babies: Open the airway to a neutral position using the head-tilt/chin-lift technique.</li>
                        </ul>
                    </li>
                    <li>
                        Pinch the nose shut, take a normal breath, and make a complete seal over the person’s mouth with your mouth.
                        <ul>
                            <li>Ensure each breath lasts about 1 second and makes the chest rise; allow air to exit before giving the next breath.</li>
                            <li>
                                Note: If the 1st breath does not cause the chest to rise, retilt the head and ensure a proper seal before giving the 2nd breath If the 2nd breath does not make the chest rise, an object may be blocking the airway.
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li>Roles are exchanged every 5 cycles.</li>
            <li>Continue until help arrives, an automated external defibrillator (AED) is available or the emergency personnel arrives, or the victim is revived back to life.</li>
        </ol>
    </div>
</div>

<script>
    document.getElementById('home-content').style.display = 'block';

    function showInfo(infoId) {
        var infoContainers = document.querySelectorAll(".info-container");
        for (var i = 0; i < infoContainers.length; i++) {
            infoContainers[i].style.display = "none";
        }
        document.getElementById(infoId).style.display = "block";
    }
</script>
</body>
</html>