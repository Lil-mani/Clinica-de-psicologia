<?php

use App\Http\Controllers\ProfileController;
use App\Models\Userdata;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Rotas para a pagina principal
Route::get('/', function () {
    return Inertia::render('PaginaPrincipal', [
        'canLogin' => Route::has('login'),   // pagina de login
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});



Route::get('/dashboard', function () {
    $user = auth()->user();
    $role = DB::table('userdatas')->where('email', $user->email)->value('role');
    //Log::info('Acesso ao Dashboard:', ['user_id' => $user->id, 'role' => $role]);
    if ($role === 'psicologo') {
        return Inertia::render('PaginaPsicologo');
    }   
    elseif ($role === 'secretaria') {
        return Inertia::render('PaginaSecretaria');
    }
    elseif ($role === 'user' || $role === 'admin') {
        return Inertia::render('Dashboard');
    }
    else {
        abort(403,'Não autorizado');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/doctor', function () {
    return Inertia::render('PaginaPsicologo');
})->middleware(['auth',''])->name('doctor');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
