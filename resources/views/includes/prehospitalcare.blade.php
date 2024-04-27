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

        <form method="GET" action="{{ route('prehospital') }}">
            @csrf
            <button type="submit" class="btn btn-primary btn-block">New Pre-Hospital Care Report</button>
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
                                    <th>Patient Name</th>
                                    <th>Contact Number</th>
                                    <th>Address</th>
                                    <th>Sex</th>
                                    <th>Age</th>
                                    <th>Blood Type</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($prehospitalEvents as $event1)
                                <tr>
                                    <td>{{ $event1->patient_id }}</td>
                                    <td>{{ $event1->full_name }}</td>
                                    <td>{{ $event1->contact_num_p }}</td>
                                    <td>{{ $event1->address_p }}</td>
                                    <td>{{ $event1->sex }}</td>
                                    <td>{{ $event1->age }}</td>
                                    <td>{{ $event1->blood_type }}</td>
                                    <td>
                                    <!-- <div class="btn-group" role="group" style="height: 100%;"> -->
                                        <a href="{{ route('view_pcr', ['patient_id' => $event1->patient_id]) }}" class="btn btn-primary btn-sm" style="height: 100%; border-radius: 0;">
                                            <i class="fas fa-eye"></i>
                                        </a>
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