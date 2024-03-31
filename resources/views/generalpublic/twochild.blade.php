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
            background-color: #EDF1F6;
            font-family: Helvetica;
            font-weight: bold;
            color: #4D4D4D;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .smaller-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

         .button-startcpr {
            background-color: #28a745;
            color: white;
            border: none;
            height: 50px;
            width: 200px;
            border-radius: 20px;
            padding: 10px 20px;
            cursor: pointer;
            margin-top: 30px;
        }

        .button-startcpr:hover {
            background-color: #218838;
        }

        h1, h2, h3{
            font-weight: bold;
            text-align: center;
        }

        h3{
            margin-top: 20px;
            margin-bottom: 30px;
        }

        
    </style>
</head>
<body>
<div class="container">
    <div class = "smaller-container">
        <div class="d-flex justify-content-center align-items-center" style="height: 100%">
            <h1>REMINDERS</h1>
        </div>

        <div class="d-flex justify-content-center align-items-center" style="height: 100%">
            <h2>2 RESCUERS, CHILD</h2>
        </div>

        <div class="d-flex justify-content-center align-items-center" style="height: 100%">
            <h3>15 chest compressions, 2 short breaths</h3>
        </div>

        <div class="d-flex justify-content-center align-items-center" style="height: 100%">
            <ul>
                <li>Compression Depth: 1/3 of the chest diameter, about 2 inches.</li>
                <li>Compression Rate: 100-120 compressions per minute.</li>
            </ul>
        </div>
        
        <div class="row">
            <div class="d-flex justify-content-center align-items-center" style="height: 100%">
                <button class="button-startcpr" onclick="window.location='{{ route('cprscreenii') }}'">
                    <span class="startcpr">START CPR</span>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
   
</script>
</body>
</html>