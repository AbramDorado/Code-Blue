<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PreHospitalController extends Controller
{
    public function index()
    {
        // Add any necessary logic here
        return view('prehospital');
    }
}