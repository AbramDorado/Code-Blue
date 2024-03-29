@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exported Project</title>

<style>
    body {
    background-color: #f5f5f5;
    font-family: Arial, sans-serif;
}
</style>
</head>
<body>
    <div class="generalpublic-container">
        <div class="generalpublic">
            <button class="generalpublic-button-1">
                <span class="generalpublic-1">1</span>
            </button>
            <button class="generalpublic-button-2">
                <span class="generalpublic-2">2</span>
            </button>
            <button class="generalpublic-button-adult">
                <span class="generalpublic-adult">
                    <span>ADULT</span>
                </span>
            </button>
            <button class="generalpublic-button-child">
                <span class="generalpublic-child">
                    <span>CHILD</span>
                </span>
            </button>
            <span class="generalpublic-rescuers">
                <span>NO. OF RESCUERS</span>
            </span>
            <span class="generalpublic-victim">
                <span>VICTIM</span>
            </span>
            <button class="generalpublic-button-startcpr" onclick="window.location='{{ route('reminders') }}'">
                <span class="generalpublic-startcpr">
                    <span>START CPR</span>
                </span>
            </button>
        </div>
    </div>
</body>
</html>
