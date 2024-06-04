<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Userdata extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password', 
        'cpf', 
        'telefone', 
        'dob', 
        'cep', 
        'logradouro', 
        'complemento', 
        'bairro', 
        'localidade', 
        'uf', 
        'role',
    ];
}
