<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Userdata;
use App\Models\Appointment;
use Illuminate\Support\Facades\Hash;
use App\Models\PatientRecord;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Limpar a tabela de usuários
        User::truncate();
        Userdata::truncate();
        Appointment::truncate();
        PatientRecord::truncate();
        // Criar usuários de exemplo
        User::create([
            'name' => 'Secretaria',
            'email' => 'secretaria@email.com',
            'password' => Hash::make('secretaria')
        ]);
        Userdata::create([
            'name' => 'Secretaria',
            'email' => 'secretaria@email.com',
            'password' => 'secretaria',
            'cpf' => '12332112332',
            'telefone' => '21989603133',
            'dob' => '2003-01-27',
            'cep' => '13082756',
            'logradouro' => 'logradouro x',
            'complemento' => 'complemento y',
            'bairro' => 'bairro z',
            'localidade' => 'Nlogonia',
            'uf' => 'SP',
            'role' => 'secretaria'
        ]);

        PatientRecord::create([
            'name' => 'Secretaria',
            'email' => 'secretaria@email.com'
        ]);

        User::create([
            'name' => 'Usuario',
            'email' => 'usuario@email.com',
            'password' => Hash::make('usuario')
        ]);
        Userdata::create([
            'name' => 'Usuario',
            'email' => 'usuario@email.com',
            'password' => 'usuario',
            'cpf' => '15531255332',
            'telefone' => '19982603133',
            'dob' => '2001-08-10',
            'cep' => '13082755',
            'logradouro' => 'logradouro x',
            'complemento' => 'complemento y',
            'bairro' => 'bairro z',
            'localidade' => 'Nlogonia',
            'uf' => 'SP',
            'role' => 'usuario'
        ]);

        PatientRecord::create([
            'name' => 'Usuario',
            'email' => 'usuario@email.com'
        ]);

        User::create([
            'name' => 'Psicologo',
            'email' => 'psicologo@email.com',
            'password' => Hash::make('psicologo')
        ]);
        Userdata::create([
            'name' => 'Psicologo',
            'email' => 'psicologo@email.com',
            'password' => 'psicologo',
            'cpf' => '99933342319',
            'telefone' => '19977803133',
            'dob' => '1970-06-01',
            'cep' => '13082752',
            'logradouro' => 'logradouro x',
            'complemento' => 'complemento y',
            'bairro' => 'bairro z',
            'localidade' => 'Nlogonia',
            'uf' => 'SP',
            'role' => 'psicologo'
        ]);

        PatientRecord::create([
            'name' => 'Psicologo',
            'email' => 'psicologo@email.com',
        ]);

        User::create([
            'name' => 'Admin',
            'email' => 'admin@email.com',
            'password' => Hash::make('admin')
        ]);
        Userdata::create([
            'name' => 'admin',
            'email' => 'admin@email.com',
            'password' => 'admin',
            'cpf' => '21137387910',
            'telefone' => '19977893133',
            'dob' => '1972-12-18',
            'cep' => '13082756',
            'logradouro' => 'casa do adm',
            'complemento' => 'tlvz exista',
            'bairro' => 'bairro a',
            'localidade' => 'Nlogonia',
            'uf' => 'SP',
            'role' => 'admin'
        ]);

        PatientRecord::create([
            'name' => 'admin',
            'email' => 'admin@email.com',
        ]);

        Appointment::create([
            'patient' => 2,
            'medic' => 3,
            'time' => '2024-06-01 10:00',
            'professional' => 'Paciente vem evoluindo muito bem',
            'referrals_made' => '',
            'therapeutics_used' => '',
            'done' => 1
        ]);
        Appointment::create([
            'patient' => 2,
            'medic' => 3,
            'time' => '2024-06-04 10:00',
            'done' => 1
        ]);

        // // Adicionar mais usuários conforme necessário
        // for ($i = 0; $i < 10; $i++) {
        //     User::create([
        //         'name' => "User $i",
        //         'email' => "user$i@example.com",
        //         'password' => Hash::make('password123')
        //     ]);
        // }
    }
}
