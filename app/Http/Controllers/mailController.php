<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\cadastro;
use App\Mail\LoginInfo;
use Illuminate\Support\Facades\Mail;

class mailController extends Controller
{
    public function sendEmail(Request $request){
        // mandando um email para fake@mail.com
        $name = $request->name;
        $email = $request->email;
        Mail::to($email)->send(new cadastro($name));

        return response()->json(['message'=> 'Email enviado.'],200);
    }

    public function sendLoginInfo(Request $request){
        // mandando um email para fake@mail.com
        $name = $request->name;
        $email = $request->email;
        $password = $request->password;
        Mail::to($email)->send(new LoginInfo($name, $email, $password));

        return response()->json(['message'=> 'Email enviado.'],200);
    }
}
