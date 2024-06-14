<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\PatientRecordController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// rota para guardar info de contato
Route::post('/contacts', [ContactController::class, 'store']);
Route::get('/contacts', [ContactController::class, 'index']);

Route::post('/appointments', [AppointmentController::class,'store']);
Route::get('/appointments', [AppointmentController::class, 'show']);
Route::get('/userfutureappointments/{id}', [AppointmentController::class,'show_future_patient_appointments']);
Route::get('/userpastappointments/{id}', [AppointmentController::class,'show_past_patient_appointments']);

Route::get('/usuarios', [RegisteredUserController::class,'show']);
Route::post('/records',[PatientRecordController::class,'store']);


// rota utilizada para coletar a lista de psicologos atualmente cadastrada no banco de dados
Route::get('/psychologists', [RegisteredUserController::class, 'getPsicologos']);


