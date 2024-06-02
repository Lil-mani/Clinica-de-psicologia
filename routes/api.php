<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Isso é referente ao formulario do usuario
// Route::post('/contato', function (Request $request) {
//     // Valide e processe os dados do formulário de contato aqui
//     // Por exemplo:
//     $validatedData = $request->validate([
//         'nome' => 'required|string|max:255',
//         'sobrenome' => 'required|string|max:255',
//         'email' => 'required|email|max:255',
//         'mensagem' => 'required|string',
//     ]);

//     // Salve os dados do formulário, envie um e-mail, ou faça o que for necessário

//     // Retorne uma resposta de sucesso
//     return response()->json(['message' => 'Formulário de contato recebido com sucesso!']);
// });
