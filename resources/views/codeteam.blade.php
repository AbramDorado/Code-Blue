<!-- This is codeteam.blade.php -->

@extends('layouts.master')

@section('content')
<div class="jumbotron">
  <h1 class="display-10">Code Team</h1>
  <p class="lead">Code Team</p>
  <!-- Add a dropdown button to toggle the menu -->
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Toggle Menu
  </button>
  
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <!-- Your list of buttons goes here -->
    <a class="dropdown-item" href="{{ route('maininformation', ['code_number' => $code_number]) }}">Main Information</a>
    <a class="dropdown-item" href="{{ route('initialresuscitation', ['code_number' => $code_number]) }}">Initial Resuscitation</a>
    <a class="dropdown-item" href="{{ route('flowsheet', ['code_number' => $code_number]) }}">Flowsheet</a>
    <a class="dropdown-item" href="{{ route('outcome', ['code_number' => $code_number]) }}">Outcome of the Code</a>
    <a class="dropdown-item" href="{{ route('evaluation', ['code_number' => $code_number]) }}">Debriefing and Evaluation</a>
    <a class="dropdown-item" href="{{ route('codeteam', ['code_number' => $code_number]) }}">Code Team</a>
  </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Code Team</div>
                <div class="card-body">
                   
                <form method="POST" action="{{ route('store_codeteam', ['code_number' => $code_number]) }}">
    @csrf
                        <!-- Code Team Leader -->
                    <div class="form-group">
                        <label for="code_team_leader">Code Team Leader:</label>
                        <select class="form-control" name="code_team_leader" id="code_team_leader" required>
                            <option value="" disabled selected>Select</option>
                            @foreach($users as $user)
                                <option value="{{ $user->name }}" {{ old('code_team_leader') == $user->name ? 'selected' : '' }}>{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Code Team Co-Leader -->
                    <div class="form-group">
                        <label for="code_team_co_leader">Code Team Co-Leader:</label>
                        <select class="form-control" name="code_team_co_leader" id="code_team_co_Leader">
                            <option value="" disabled selected>Select</option>
                            <option value="-1" {{ old('code_team_co_leader') == '-1' ? 'selected' : '' }}>None</option>
                            @foreach($users as $user)
                                <option value="{{ $user->name }}" {{ old('code_team_co_leader') == $user->name ? 'selected' : '' }}>{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Recorder -->
                    <div class="form-group">
                        <label for="recorder">Recorder:</label>
                        <select class="form-control" name="recorder" id="recorder" required>
                            <option value="" disabled selected>Select</option>
                            @foreach($users as $user)
                                <option value="{{ $user->name }}" {{ old('recorder') == $user->name ? 'selected' : '' }}>{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Code Team Member -->
                    <div class="form-group">
                        <!-- Your existing code for adding/removing members -->

                        <!-- Initial dropdown field with old input support -->
                        <select class="form-control" name="code_team_member[]" id="user1">
                            <option value="" disabled selected>Select</option>
                            @foreach($users as $user)
                                <option value="{{ $user->name }}" {{ old('code_team_member.0') == $user->name ? 'selected' : '' }}>{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Intubated by -->
                    <div class="form-group">
                        <label for="intubated_by">Intubated by:</label>
                        <select class="form-control" name="intubated_by" id="intubated_by">
                            <option value="" disabled selected>Select</option>
                            <option value="-1" {{ old('intubated_by') == '-1' ? 'selected' : '' }}>None</option>
                            @foreach($users as $user)
                                <option value="{{ $user->name }}" {{ old('intubated_by') == $user->name ? 'selected' : '' }}>{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Your existing code for other form elements -->

                    <form action="{{ route('store_codeteam', ['code_number' => $code_number]) }}" method="post">
                        @csrf 
                        <button type="submit" class="btn btn-primary btn-block">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var container = document.getElementById('code_team_member_container');
        var addButton = document.getElementById('add_member');
        var removeButton = document.getElementById('remove_member');
        var numMembersInput = document.getElementById('num_members');

        var maxFields = 12; // Set the maximum number of fields

        var counter = 1;

        addButton.addEventListener('click', function () {
            var numMembers = parseInt(numMembersInput.value);
            if (counter + numMembers <= maxFields) {
                addDropdowns(numMembers);
                counter += numMembers;
            } else {
                alert('Exceeds the maximum limit of ' + maxFields + ' fields.');
            }
        });

        removeButton.addEventListener('click', function () {
            var numMembers = parseInt(numMembersInput.value);
            if (counter - numMembers >= 1) {
                removeDropdowns(numMembers);
                counter -= numMembers;
            }
        });

        numMembersInput.addEventListener('change', function () {
            var numMembers = parseInt(numMembersInput.value);
            if (numMembers < 1) {
                numMembersInput.value = 1;
            } else if (numMembers > maxFields) {
                numMembersInput.value = maxFields;
                alert('Exceeds the maximum limit of ' + maxFields + ' fields.');
            }

            // Update dropdowns to match the desired count
            updateDropdowns(numMembers);
        });

        numMembersInput.addEventListener('keypress', function (event) {
            if (event.key === 'Enter') {
                event.preventDefault();
                var numMembers = parseInt(numMembersInput.value);
                if (numMembers > 0 && numMembers <= maxFields) {
                    updateDropdowns(numMembers);
                } else if (numMembers > maxFields) {
                    numMembersInput.value = maxFields;
                    alert('Exceeds the maximum limit of ' + maxFields + ' fields.');
                }
            }
        });

        function addDropdowns(num) {
            for (var i = 0; i < num; i++) {
                var newDropdown = document.createElement('div');
                newDropdown.className = 'form-group';

                var selectDropdown = document.createElement('select');
                selectDropdown.className = 'form-control';
                selectDropdown.name = 'code_team_member[]';
                selectDropdown.id = 'user' + counter;

                var defaultOption = document.createElement('option');
                defaultOption.value = '';
                defaultOption.disabled = true;
                defaultOption.selected = true;
                defaultOption.appendChild(document.createTextNode('Select'));

                selectDropdown.appendChild(defaultOption);

                @foreach($users as $user)
                    var option = document.createElement('option');
                    option.value = '{{ $user->name }}';
                    option.appendChild(document.createTextNode('{{ $user->name }}'));
                    selectDropdown.appendChild(option);
                @endforeach

                newDropdown.appendChild(selectDropdown);
                container.appendChild(newDropdown);
            }
        }

        function removeDropdowns(num) {
            var dropdowns = document.querySelectorAll('.form-group');
            var numToRemove = Math.min(num, dropdowns.length);

            for (var i = 0; i < numToRemove; i++) {
                container.removeChild(container.lastChild);
            }
        }

        function updateDropdowns(num) {
            // Ensure the current count is correct
            numMembersInput.value = num;

            // Remove excess dropdowns
            while (counter > num) {
                removeDropdowns(1);
                counter--;
            }

            // Add or update dropdowns to match the desired count
            while (counter < num) {
                addDropdowns(1);
                counter++;
            }
        }
    });
</script>

<!-- ... (remaining code) ... -->

@endsection
