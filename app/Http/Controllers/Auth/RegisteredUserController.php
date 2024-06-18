<?php

namespace App\Http\Controllers\Auth;
use App\Models\PatientRecord;
use Validator;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Userdata;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Registra um usuário e redireciona para a tela de login.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // checa se todos os dados necessários estao presentes
        // eu acho que nao precisa de um try catch aqui, mas c'est la vie
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'cpf' => ['required', 'string', 'max:14'],
            'telefone' => ['required', 'string', 'max:15'],
            'dob' => ['required', 'date'],
            'cep' => ['required', 'string', 'max:9'],
            'logradouro' => ['nullable', 'string', 'max:255'],
            'complemento' => ['nullable', 'string', 'max:255'],
            'bairro' => ['nullable', 'string', 'max:255'],
            'localidade' => ['nullable', 'string', 'max:255'],
            'uf' => ['nullable', 'string', 'max:2'],
            'role' => ['required', 'string', 'max:255'],
        ]);
        // registra no banco de dados users, sendo esse o banco de dados usado para dar login
        // users contem nome, email, e senha criptografada.
        // userdatas contem muito mais, e a senha NAO criptografada.
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        // registra no bando de dados de userdatas (sendo esse a tabela de dados de usuários)
        // os dados do usuario a ser registrado
        $userdata = Userdata::create([
            'name' => $request->name,
            'email' => $request->email,
            'password'=> $request->password,
            'cpf' => $request->cpf,
            'telefone' => $request->telefone,
            'dob' => $request->dob,
            'cep' => $request->cep,
            'logradouro' => $request->logradouro,
            'bairro' => $request->bairro,
            'localidade' => $request->localidade,
            'uf' => $request->uf,
            'role' => $request->role,
        ]);

        event(new Registered($user));
        // salva o usuário no banco de dados
        $user->save();
        // se quiser logar com o usuário:
        // Auth::login($user);

        // redireciona para o home, que seria a tela de login
        return redirect(RouteServiceProvider::HOME);
    }
    /**
    * A função abaixo registra um novo usuário no banco de dados sem redirecionar o usuário atual para o home.
    **/
    public function store_no(Request $request)
    {
        // checa se todos os dados necessários estao presentes
        // eu acho que nao precisa de um try catch aqui, mas c'est la vie
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'cpf' => ['required', 'string', 'max:14'],
            'telefone' => ['required', 'string', 'max:15'],
            'dob' => ['required', 'date'],
            'cep' => ['required', 'string', 'max:9'],
            'logradouro' => ['nullable', 'string', 'max:255'],
            'complemento' => ['nullable', 'string', 'max:255'],
            'bairro' => ['nullable', 'string', 'max:255'],
            'localidade' => ['nullable', 'string', 'max:255'],
            'uf' => ['nullable', 'string', 'max:2'],
            'role' => ['required', 'string', 'max:255'],
        ]);
        // registra no banco de dados users, sendo esse o banco de dados usado para dar login
        // users contem nome, email, e senha criptografada.
        // userdatas contem muito mais, e a senha NAO criptografada.
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        // registra no bando de dados de userdatas (sendo esse a tabela de dados de usuários)
        // os dados do usuario a ser registrado
        $userdata = Userdata::create([
            'name' => $request->name,
            'email' => $request->email,
            'password'=> $request->password,
            'cpf' => $request->cpf,
            'telefone' => $request->telefone,
            'dob' => $request->dob,
            'cep' => $request->cep,
            'logradouro' => $request->logradouro,
            'bairro' => $request->bairro,
            'localidade' => $request->localidade,
            'uf' => $request->uf,
            'role' => $request->role,
        ]);

        $records = PatientRecord::create([
            'name' => $request->name,
            'email'=> $request->email
        ]);

        event(new Registered($user));

        $user->save();
        //Auth::login($user);
    }
    /**
      *  Retorna uma lista com os ids e nomes de todos os psicologos
    **/
    public function getPsicologos()
    {
        // coleta os dados de id e nome no banco de dados de todos os psicologos
        $names = Userdata::where('role','psicologo')->pluck('id','name');
        // profissionaisTransformados é utilizado para que na tela em que os dados sejam chamandos,
        // os dados poderem ser acessados da forma => exemplo.id & exemplo.name.
        $profissionaisTransformados = $names->map(function ($id, $nome) {
            return ['name' => $nome, 'id' => $id];
        });
        return response()->json($profissionaisTransformados);
    }

    public function getUsers() {
        $users = Userdata::where('role','usuario')->pluck('id','name');

        $usersTransformados = $users->map(function ($id, $nome) {
            return ['name' => $nome, 'id' => $id];
        });
        return response()->json($usersTransformados);

    }

    /**
     * Função puxa o nome do usuario de id fornecido.
     */
    public function showName($id) {
        $user = Userdata::find($id);
        return response()->json($user->name);
    }


    public function show() {
        $users = Userdata::get();
        return response()->json($users);
    }

    public function showUserInfo($id) {
        $user = Userdata::find($id);

        if ($user) {
            $userInfo = [
                'name' => $user->name,
                'email' => $user->email,
                'cpf' => $user->cpf,
                'telefone' => $user->telefone,
                'dob' => $user->dob, // Corrigido de 'dob' -> para 'dob' =>
                'cep' => $user->cep,
                'logradouro' => $user->logradouro,
                'complemento' => $user->complemento,
                'bairro' => $user->bairro,
                'localidade' => $user->localidade, // Corrigido de 'localdidade' para 'localidade'
                'uf' => $user->uf
            ];

        return response()->json($userInfo);
    } else {
        return response()->json(['message' => 'User not found'], 404);
    }
    }
}
