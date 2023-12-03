<?php

use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\FlowsheetController;
use App\Http\Controllers\InitialResuscitationController;
use App\Http\Controllers\OutcomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FingerDevicesControlller;
use App\Http\Controllers\CodeTeamController;
use App\Http\Controllers\MainInformationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\ViewController;


Route::get('/', function () {
    return view('welcome');
})->name('welcome');
Route::get('attended/{user_id}', '\App\Http\Controllers\AttendanceController@attended' )->name('attended');
Route::get('attended-before/{user_id}', '\App\Http\Controllers\AttendanceController@attendedBefore' )->name('attendedBefore');
Auth::routes(['register' => false, 'reset' => false]);

Route::group(['middleware' => ['auth', 'Role'], 'roles' => ['admin']], function () {

    Route::get('/admin', '\App\Http\Controllers\AdminController@index')->name('admin');
});

Route::get('/codeblueforms', function(){
    return view('includes/codeblueforms');
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

// Route::get('/codeteam', [CodeTeamController::class, 'showCodeTeamForm']);
// Route::get('/evaluation', [EvaluationController::class, 'index'])->name('evaluation');
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::post('/store_user', [UserController::class, 'store'])->name('store_user');

Route::put('/update_user/{id}', [UserController::class, 'updateUser'])->name('update_user');

Route::get('/codeteam/{code_number}', [CodeTeamController::class, 'index'])->name('codeteam');
Route::post('/codeteam/{code_number}', [CodeTeamController::class, 'store'])->name('store_codeteam');

Route::get('/initialresuscitation/{code_number}', [InitialResuscitationController::class, 'index'])->name('initialresuscitation');
Route::post('/initialresuscitation/{code_number}', [InitialResuscitationController::class, 'store'])->name('store_initialresuscitation');

Route::get('/flowsheet/{code_number}', [FlowsheetController::class, 'index'])->name('flowsheet');
// Route::get('/flowsheet/{code_number}/data', [FlowsheetController::class, 'getFlowsheetsData'])->name('flowsheets.index');
Route::post('/flowsheet/{code_number}', [FlowsheetController::class, 'store'])->name('store_flowsheet'); 

Route::get('/evaluation/{code_number}', [EvaluationController::class, 'index'])->name('evaluation');
Route::post('/evaluation/{code_number}', [EvaluationController::class, 'store'])->name('store_evaluation');

Route::get('/outcome/{code_number}', [OutcomeController::class, 'index'])->name('outcome');
Route::post('/outcome/{code_number}', [OutcomeController::class, 'store'])->name('store_outcome');

Route::get('/maininformation/{code_number}', [MainInformationController::class, 'index'])->name('maininformation');
Route::post('/maininformation/{code_number}', [MainInformationController::class, 'store'])->name('store_maininformation');
Route::get('/searchPatientPins', [MainInformationController::class, 'searchPatientPins'])->name('searchPatientPins');
Route::get('/fetchPatientInformation', [MainInformationController::class, 'fetchPatientInformation'])->name('fetchPatientInformation');
Route::get('/fetchPatientPin', [MainInformationController::class, 'fetchPatientPin'])->name('fetchPatientPin');


Route::get('/codeblueforms', '\App\Http\Controllers\FormController@index')->name('includes/codeblueforms');

Route::put('/update_patient/{id}', [MainInformationController::class, 'updatePatient'])->name('update_patient');

// Route::get('/maininformationview', '\App\Http\Controllers\MainInformationController@index')->name('maininformationview');


Route::delete('/delete-user/{id}', '\App\Http\Controllers\UserController@deleteUser')->name('delete_user');


Route::get('/codeblueforms/{patient_pin}/{code_number}/view', [FormController::class, 'viewCodeBlue'])->name('view_codeblueforms');
// Route::get('/codeblueforms/{code_number}/edit', [FormController::class, 'edit'])->name('edit_codeblueforms');
Route::post('/codeblueforms/{code_number}/archive', [FormController::class, 'archive'])->name('archive_codeblueforms');


//for achrive
Route::get('/archived_codeblueforms', 'App\Http\Controllers\ArchiveController@archivedCodeBlueForms')->name('archived_codeblueforms');
Route::patch('/unarchive_codeblueforms/{code_number}', [FormController::class,'unarchive'])->name('unarchive_codeblueforms');


Route::get('/download-pdf/{codeEvent}', [PdfController::class, 'download'])->name('download-pdf');


Route::group(['middleware' => ['auth']], function () {


});
