<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\FlowsheetController;
use App\Http\Controllers\InitialResuscitationController;
use App\Http\Controllers\OutcomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FingerDevicesControlller;
use App\Http\Controllers\CodeTeamController;
use App\Http\Controllers\MainInformationController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\ViewController;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\FirstAiderController;
use App\Http\Controllers\PreHospitalController;
use App\Http\Controllers\LevelOfConsciousnessController;
use App\Http\Controllers\SampleHistoryController;
use App\Http\Controllers\VitalSignsController;
use App\Http\Controllers\HTAssessmentController;
use App\Http\Controllers\RMFInformationController;

Route::get('/', function () {
    \Illuminate\Support\Facades\Mail::send(new \App\Mail\EmailHospital());
    return view('auth/login');
})->name('welcome');
Route::get('attended/{user_id}', '\App\Http\Controllers\AttendanceController@attended' )->name('attended');
Route::get('attended-before/{user_id}', '\App\Http\Controllers\AttendanceController@attendedBefore' )->name('attendedBefore');
Auth::routes(['register' => false, 'reset' => false]);

// Route::group(['middleware' => ['auth', 'Role'], 'roles' => ['admin']], function () {

//     Route::get('/admin', '\App\Http\Controllers\AdminController@index')->name('admin');
// });

Route::get('/', function () {
    return view('auth/login');
})->name('welcome');

// Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
// Route::post('/login', [LoginController::class, 'login']);

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);


Route::get('/codeblueforms', function(){
    return view('includes/codeblueforms');
});

Route::get('/prehospitalcare', function(){
    return view('includes/prehospitalcare');
});

Route::get('/maininformation', function () {
    return view('maininformation');
});

Route::get('/initialresuscitation', function(){
    return view('initialresuscitation');
});

Route::get('/flowsheet', function(){
    return view('flowsheet');
});

Route::get('/outcome', function(){
    return view('outcome');
});

Route::get('/evaluation', function(){
    return view('evaluation');
});

Route::get('/codeteam', function(){
    return view('codeteam');
});

Route::get('/users', function(){
    return view('users');
});

//users
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::post('/store_user', [UserController::class, 'store'])->name('store_user');

//medical personell screens

Route::put('/update_user/{id}', [UserController::class, 'updateUser'])->name('update_user');

Route::get('/codeteam/{code_number}', [CodeTeamController::class, 'index'])
    ->name('codeteam')
    ->middleware('web');

Route::post('/codeteam/{code_number}', [CodeTeamController::class, 'store'])->name('store_codeteam');

Route::get('/initialresuscitation/{code_number}', [InitialResuscitationController::class, 'index'])->name('initialresuscitation');
Route::post('/initialresuscitation/{code_number}', [InitialResuscitationController::class, 'store'])->name('store_initialresuscitation');

Route::get('/flowsheet/{code_number}', [FlowsheetController::class, 'index'])->name('flowsheet');
Route::get('/evaluation/{code_number}', [EvaluationController::class, 'index'])->name('evaluation');
Route::post('/evaluation/{code_number}', [EvaluationController::class, 'store'])->name('store_evaluation');

Route::get('/outcome/{code_number}', [OutcomeController::class, 'index'])->name('outcome');
Route::post('/outcome/{code_number}', [OutcomeController::class, 'store'])->name('store_outcome');

Route::get('/maininformation/{code_number}', [MainInformationController::class, 'index'])->name('maininformation');
Route::post('/maininformation/{code_number}', [MainInformationController::class, 'store'])->name('store_maininformation');

Route::get('/searchPatientPins', [PatientController::class, 'searchPatientPins'])->name('searchPatientPins');
Route::get('/fetchPatientInformation', [PatientController::class, 'fetchPatientInformation'])->name('fetchPatientInformation');
Route::get('/fetchPatientPin', [PatientController::class, 'fetchPatientPin'])->name('fetchPatientPin');
Route::get('/fetchFlowsheetInformation/{code_number}', [FlowsheetController::class, 'fetchFlowsheetInformation'])->name('fetchFlowsheetInformation');

Route::delete('/destroy/{id}', [FlowsheetController::class, 'destroy'])->name('destroy');
Route::get('/edit/{id}', [FlowsheetController::class, 'edit'])->name('edit');
Route::put('/update/{id}', [FlowsheetController::class, 'update'])->name('update');
Route::post('/store/{code_number}', [FlowsheetController::class, 'store'])->name('store_flowsheet'); 
Route::get('/codeblueforms', '\App\Http\Controllers\FormController@index')->name('includes/codeblueforms');

Route::delete('/delete-user/{id}', '\App\Http\Controllers\UserController@deleteUser')->name('delete_user');

Route::get('/codeblueforms/{patient_pin}/{code_number}/view', [FormController::class, 'viewCodeBlue'])->name('view_codeblueforms');
Route::post('/codeblueforms/{code_number}/archive', [FormController::class, 'archive'])->name('archive_codeblueforms');

Route::get('/archived_codeblueforms', 'App\Http\Controllers\ArchiveController@archivedCodeBlueForms')->name('archived_codeblueforms');
Route::patch('/unarchive_codeblueforms/{code_number}', [FormController::class,'unarchive'])->name('unarchive_codeblueforms');

Route::get('/download-pdf/{codeEvent}', [PdfController::class, 'download'])->name('download-pdf');
Route::get('/download-excel', [ExcelController::class, 'export'])->name('download-excel');

Route::post('/codeblueforms/{code_number}/finalize', [FormController::class, 'finalize'])->name('finalize_codeblueforms');

//general public screens
Route::get('/generalpublic', function(){
    return view('generalpublic/homescreen');
})->name('generalpublic');

Route::get('/cprscreen', function(){
    return view('generalpublic/cprscreen');
})->name('cprscreen');

Route::get('/cprscreenii', function(){
    return view('generalpublic/cprscreenii');
})->name('cprscreenii');

Route::get('/onechild', function(){
    return view('generalpublic/onechild');
})->name('onechild');

Route::get('/oneadult', function(){
    return view('generalpublic/oneadult');
})->name('oneadult');

Route::get('/twochild', function(){
    return view('generalpublic/twochild');
})->name('twochild');

Route::get('/twoadult', function(){
    return view('generalpublic/twoadult');
})->name('twoadult');

Route::get('/hotlines', function () {
    return view('generalpublic/hotlines');
})->name('hotlines');

Route::get('/howtocpr', function () {
    return view('generalpublic/howtocpr');
})->name('howtocpr');

Route::group(['middleware' => ['auth']], function () {

// =========================== ersion 2 pages ==========================================
Route::get('/prehospital/{patient_id}', [PreHospitalController::class, 'index'])->name('prehospital');
Route::post('/prehospital', [PreHospitalController::class, 'store'])->name('store_medicalinfo');
Route::get('/prehospitalcare', '\App\Http\Controllers\FirstAiderController@index')->name('includes/prehospitalcare');
Route::get('/prehospitalcare/{patient_id}/view', '\App\Http\Controllers\FirstAiderController@viewForms')->name('view_pcr');
Route::get('/download-PCRpdf/{patient_id}', [PdfController::class, 'downloadPCR'])->name('download-PCRpdf');


Route::get('/levelofconsciousness', [LevelOfConsciousnessController::class, 'index'])->name('levelofconsciousness');
Route::post('/levelofconsciousness', [LevelOfConsciousnessController::class, 'store'])->name('store_levelofconsciousness');

Route::get('/samplehistory', [SampleHistoryController::class, 'index'])->name('samplehistory');
Route::post('/samplehistory', [SampleHistoryController::class, 'store'])->name('store_samplehistory');

Route::get('/vitalsigns', [VitalSignsController::class, 'index'])->name('vitalsigns');
Route::post('/vitalsigns', [VitalSignsController::class, 'store'])->name('store_vitalsigns');

Route::get('/htassessment', [HTAssessmentController::class, 'index'])->name('htassessment');
Route::post('/htassessment', [HTAssessmentController::class, 'store'])->name('store_htassessment');

Route::get('/rmfinformation', [RMFInformationController::class, 'index'])->name('rmfinformation');
Route::post('/rmfinformation', [RMFInformationController::class, 'store'])->name('store_rmfinformation');


});
