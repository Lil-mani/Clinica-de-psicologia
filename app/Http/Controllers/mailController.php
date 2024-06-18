<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\cadastro;
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
}
