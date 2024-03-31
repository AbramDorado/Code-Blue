@extends('layouts.master-blank')

@section('content')
    <style>
        body {
            font-family: Helvetica, sans-serif;
            overflow: hidden;
            margin: 0;
            padding: 0;
        }

        .page {
            display: flex;
            height: 100vh;
            width: 100%;
        }

        .left-content {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .right-content {
            flex: 1;
            position: relative;
            overflow: hidden;
            width: 1000px;
        }

        .background-filter {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            background-image: url('assets/images/login.png');
            background-size: cover;
            filter: blur(0px);
        }

        .card {
            position: absolute;
            top: 60%;
            left: 75%;
            right: 0%;
            transform: translate(-50%, -50%);
            width: 500px;
            border-radius: 10px;
            /* box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.1); */
            overflow: hidden;
            z-index: 1;
            background-color: transparent;
        }

        @media(max-width: 1220px) {
            .card {
                position: absolute;
                top: 60%;
                left: 50%;
                right: 0%;
                transform: translate(-50%, -50%);
                width: 500px;
                border-radius: 10px;
                /* box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.1); */
                overflow: hidden;
                z-index: 1;
                background-color: #EDF1F6;
            }
        }

        .bg-hospital-blue {
            padding: 10px 20px 0 20px;
            text-align: center;
            position: relative;
            background-color: transparent; /* Adding a background color */
        }

        .bg-hospital-blue img {
            display: block;
            margin: 0 auto; /* Center the image */
            max-width: 80%; /* Adjust the image size */
        }

        .bg-hospital-blue p {
            color: #d1d1d1;
            margin-bottom: 20px;
        }

        .logo-admin h1 {
            font-size: 60px;
            color: #fff;
            margin-bottom: 0;
        }

        .account-card-content {
            padding: 30px 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            color: #444;
            font-size: 16px;
            font-weight: 600;
        }

        .form-control {
            border: 1px solid #ccc;
            border-radius: 5px;
            height: 40px;
            font-size: 16px;
        }

        .btn-success {
            background-color: #0A3C6B;
            border-color: #0A3C6B;
            font-size: 16px;
            font-weight: 600;
            padding: 10px 20px;
        }

        .btn-success:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .welcome-text {
            font-size: 36px;
            text-align: left;
            color: white;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
        }

        .description {
            font-size: 18px;
            text-align: center;
            margin-top: 20px;
            color: white;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
        }
        
    </style>
    <div class="background-filter"></div>
    <div class="page">
        <div class="left-content">
        <div class="card overflow-hidden account-card mx-3">
        <div class="bg-hospital-blue">
            <img src="{{ asset('assets/images/en.png') }}" alt="enCODE Logo">

        </div>
            <div class="account-card-content">
                <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group">
                        <label for="username" class="col-form-label">Username</label>
                        <input id="username" type="text" class="form-control @error('username') is-invalid @enderror"
                            name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                        @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password" class="col-form-label">Password</label>
                        <input id="password" type="password"
                            class="form-control @error('password') is-invalid @enderror" name="password" required
                            autocomplete="current-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group row m-t-20">
                        <div class="col-12 text-center">
                            <button class="btn btn-success w-md waves-effect waves-light" type="submit">Log In</button>
                        </div>
                    </div>
                </form>
                <div class="form-group row m-t-20">
                        <div class="col-12 text-center">
                            <a href="{{route('generalpublic')}}"> Log in as Guest </a>
                        </div>
                </div>
            </div>
        </div>
        </div>
    </div>
@endsection

@section('script')
@endsection