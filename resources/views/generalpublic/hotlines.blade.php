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
        background-color: #EDF1F6 !important;
    }

    span{
        font-family: Helvetica;
        font-weight: bold;
        font-size: x-large;
        color: #4D4D4D;
    }

    .container{
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .main-container {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .main{
        font-size: 30px;
        font-weight: bold;
    }

    .table-container {
        overflow-x: auto;
        max-width: 100%;
        font-family: Helvetica;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    th {
        background-color: #4D4D4D;
        color: white; 
        font-weight: bold;
    }

    td:not(:first-child) {
        padding-left: 20px;
    }
</style>
@include('layouts.gpublicmaster')
<br><br><br><br><br>
<div class="container">
    <div class = "row">
        <div class="main-container">
            <div id=eh style="font-family: Helvetica; font-weight: bold; font-size: x-large; color: #4D4D4D;">
                <span class="main">EMERGENCY HOTLINES</span>
            </div>
        <div>
    </div>
    <br>
    <div class="table-container">
    <table>
        <thead>
            <tr>
                <th>Agency Name</th>
                <th>Phone Number</th>
                <th>Specialized for</th>
                <th>Area Coverage</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Philippine Red Cross</td>
                <td>143</td>
                <td>Humanitarian aid / Blood donation</td>
                <td>Nationwide</td>
            </tr>
            <tr>
                <td>Philippine National Police</td>
                <td>911</td>
                <td>Police</td>
                <td>Nationwide</td>
            </tr>
            <tr>
                <td>Bureau of Fire Protection</td>
                <td>911</td>
                <td>Firefighting</td>
                <td>Nationwide</td>
            </tr>
            <tr>
                <td>National Complaint Hotline</td>
                <td>8888</td>
                <td>Public service</td>
                <td>Nationwide</td>
            </tr>
            <tr>
                <td>Department of Health</td>
                <td>1555</td>
                <td>Medical emergency</td>
                <td>Nationwide</td>
            </tr>
            <tr>
                <td>Bantay Bata</td>
                <td>163</td>
                <td>Child protection</td>
                <td>Nationwide</td>
            </tr>
            <tr>
                <td>Commission on Human Rights</td>
                <td>1343</td>
                <td>Human trafficking</td>
                <td>Nationwide</td>
            </tr>
            <tr>
                <td>Land Transportation Franchising and Regulatory Board</td>
                <td>1342</td>
                <td>Public transport</td>
                <td>Nationwide</td>
            </tr>
            <tr>
                <td>Metropolitan Manila Development Authority</td>
                <td>136</td>
                <td>Road traffic safety</td>
                <td>Metro Manila</td>
            </tr>
        </tbody>
    </table>
    </div>
    <br>
    <div class="form-group row m-t-20">
        <div class="col-12 text-center">
            <a href="{{route('generalpublic')}}" style="font-family: Helvetica; font-weight: bold; font-size: large; color: #4D4D4D;">BACK</a>
        </div>
    </div>
</div>

</script>
</body>
</html>
