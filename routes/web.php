<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AppointmentController;
use App\Models\Userdata;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Route::get('get-message', function (){
//     return response()->json([
//         'message' => 'Hello there, it\'s your first response.'
//     ], 200);
// });

// Route::post('post-data', function (\Illuminate\Http\Request $request){
//     return response()->json([
//         'message' => 'Your requested data is : ' . $request->full_name
//     ]);
// });

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



/*
Rotas de login, ao usuário se conectar ao site com sucesso, a rota abaixo decide
que tela ele irá ver.
*/
Route::get('/dashboard', function () {
    // as duas linhas abaixo coletam o objeto user que esta logado para passar as rotas o nome, e em alguns casos o id do usuário atual
    $user = auth()->user();
    $role = DB::table('userdatas')->where('email', $user->email)->value('role');
    // registra no log o usuário que efetuou login com sucesso
    Log::info('Acesso ao Dashboard:', ['user_id' => $user->id, 'role' => $role]);
    // rotas de tela
    if ($role === 'psicologo') {
        return Inertia::render('PaginaPsicologo', ['user' => $user->name,'userid' => $user->id]);
    }
    elseif ($role === 'secretaria') {
        return Inertia::render('PaginaSecretaria', ['user' => $user->name]);
    }
    elseif ($role === 'usuario' || $role === 'admin' || $role === 'user') {
        return Inertia::render('PaginaUsuario', ['user' => $user->name]);
    }
    // elseif ($role === 'admin') {
    //     return Inertia::render('PaginaAdmin', ['user'=> $user->name]);
    // }
    else {
        abort(403,'Não autorizado');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/doctor', function () {
//     return Inertia::render('PaginaPsicologo');
// })->middleware(['auth',''])->name('doctor');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// Route::middleware(['auth'])->group(function () {
//     Route::get('/appointments/{medic}', [AppointmentController::class, 'show']);
// });
Route::get('/appointments', [AppointmentController::class, 'show']);
Route::post('/contacts', [ContactController::class, 'store']);
Route::get('/contacts', [ContactController::class, 'index']);
Route::delete('/contact/{id}', 'ContactController@destroy');
require __DIR__.'/auth.php';
