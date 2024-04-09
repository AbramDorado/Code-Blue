@extends('layouts.master')

@section('css')
    <!-- Table css -->
    <link href="{{ URL::asset('plugins/RWD-Table-Patterns/dist/css/rwd-table.min.css') }}" rel="stylesheet" type="text/css" media="screen">
    <!-- Font Awesome css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <!-- Custom hospital style -->
    <style>
        /* Add your custom hospital styles here */
        body {
            background-color: #f5f5f5;
            font-family: Arial, sans-serif;
        }
        .card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
       
        .table-responsive .rwd-table-priority-toggle {
            display: none !important;
        }

    </style>
    </section>

    @section('button')
        @php
            $lastCodeNumber = DB::table('code_blue_activations')->orderBy('code_number', 'desc')->first();

            if ($lastCodeNumber) {
                $nextCodeNumber = $lastCodeNumber->code_number + 1;
            } else {
                $nextCodeNumber = 1;
            }
        @endphp

        <form method="GET" action="{{ route('maininformation', ['code_number' => $nextCodeNumber]) }}">
            @csrf
            <button type="submit" class="btn btn-primary btn-block">New Resuscitation Event</button>
            <a href="{{ route('prehospital') }}">Go to pcr</a><br>
            <a href="{{ route('levelofconsciousness') }}">Go to LOC</a>
        </form>
    @endsection



    @section('content')
    @include('includes.flash')

    <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
            <div class="table-rep-plugin">
                <div class="d-flex justify-content-between mb-3">
                    <form method="GET" action="{{ route('archived_codeblueforms') }}">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-archive fa-2x"></i>
                        </button>
                    </form>

                    <form method="GET" action="{{ route('download-excel') }}">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-file-excel fa-2x"></i>
                        </button>
                    </form>
                </div>


                    <div class="table-responsive" style="overflow-x: auto;">
                        <table id="datatable-buttons" class="table table-hover table-striped table-bordered dt-responsive nowrap">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Location</th>
                                    <th>Patient Name</th>
                                    <th>Event Time Started</th>
                                    <th>Event Time Ended</th>
                                    <th>Code Leader</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($resuscitationEvents as $event)
                                <tr>
                                    <td>{{ $event->code_number }}</td>
                                    <td>{{ $event->created_at }}</td>
                                    <td>{{ $event->location }}</td>
                                    <td>{{ $event->first_name }} {{ $event->last_name }}</td>
                                    <td>{{ $event->code_start_dt }}</td>
                                    <td>{{ $event->code_end_dt }}</td>
                                    <td>{{ $event->code_team_leader }}</td>
                                    <td>
                                    <!-- <div class="btn-group" role="group" style="height: 100%;"> -->
                                        <a href="{{ route('view_codeblueforms', ['patient_pin' => $event->patient_pin, 'code_number' => $event->code_number]) }}" class="btn btn-primary btn-sm" style="height: 100%; border-radius: 0;">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        <!-- Hide the edit button if the event is finalized -->
                                        @if (!$event->is_finalized)
                                            <a href="{{ route('maininformation', ['code_number' => $event->code_number]) }}" class="btn btn-primary btn-sm" style="height: 100%; border-radius: 0;">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                        @endif

                                        <form action="{{ route('archive_codeblueforms', ['code_number' => $event->code_number]) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('POST')
                                            <button type="submit" class="btn btn-primary btn-sm" style="height: 100%; border-radius: 0;">
                                                <i class="fas fa-archive"></i>
                                            </button>
                                        </form>

                                        <a href="{{ route('download-pdf', ['codeEvent' => $event->code_number]) }}" class="btn btn-primary btn-sm" style="height: 100%; border-radius: 0;">
                                            <i class="fas fa-file-pdf"></i>
                                        </a>

                                        <!-- Finalize button -->

                                        @if (!$event->is_finalized)
                                            <form method="POST" action="{{ route('finalize_codeblueforms', ['code_number' => $event->code_number]) }}">
                                                @csrf
                                                <div class="form-group" style="margin-top: 8px;">
                                                    <label for="code_team_leader_password" class="text-danger">Unfinalized</label>
                                                    <input type="password" name="code_team_leader_password" placeholder="Code Leader Password" required>
                                                    <button type="submit" class="btn btn-primary"><i class="fas fa-check-circle"></i></button>
                                                </div>
                                            </form>
                                        @else
                                            <!-- The event is finalized, hide the buttons -->
                                            <span class="text-success">Finalized</span>
                                        @endif
                                        
                                        <!-- Display an alert for incorrect password -->
                                        @if($event->code_number == session('error_code_number'))
                                            <div class="alert alert-danger mt-2">
                                                {{ session('error') }}
                                            </div>
                                        @endif
                                        <!-- End Finalize button -->
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


    @endsection

    @section('script')
        <!-- Responsive-table-->
        <script src="{{ URL::asset('plugins/RWD-Table-Patterns/dist/js/rwd-table.min.js') }}"></script>
        <script>
            $(function() {
                $('.table-responsive').responsiveTable({
                    addDisplayAllBtn: 'btn btn-secondary'
                });
            });
        </script>
    </section>