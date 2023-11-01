<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsuarioSeeder extends Seeder
{
    public function run()
    {
        $usuarioModel= new \App\Models\UsuarioModel;
        $usuario = [
            'nome' => 'Marco Aurelio Silva',
            'email' => 'admin@gmail.com',
            'cpf' => '024.566.811-62',
            'telefone' => '62982069063'
        ];
        $usuarioModel->protect(false)->insert($usuario);

        $usuarioModel = new \App\Models\UsuarioModel;
        $usuario = [
            'nome' => 'Maria Luisa',
            'email' => 'maria@gmail.com',
            'cpf' => '125.093.570-93',
            'telefone' => '62985349760'
        ];
        $usuarioModel->protect(false)->insert($usuario);
        
        dd($usuarioModel->errors());

    }
}
