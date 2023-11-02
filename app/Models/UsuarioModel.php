<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{

    protected $table            = 'usuarios';
    protected $returnType       = 'App\Entities\Usuario';
    protected $allowedFields    = ['nome', 'email', 'telefone'];
    protected $useSoftDeletes   = true;
    protected $useTimestamps        = true;
    protected $createdField         = 'criado_em'; // Nome da coluna no banco de dados
    protected $updatedField         = 'atualizado_em'; // Nome da coluna no banco de dados
    protected $deletedField         = 'deletado_em'; // Nome da coluna no banco de dados


    protected $validationRules = [
        'nome'     => 'required|max_length[120]|alpha_numeric_space|min_length[3]',
        'email'        => 'required|max_length[254]|min_length[4]|valid_email|is_unique[usuarios.email]',
        'cpf'        => 'required|exact_length[14]|is_unique[usuarios.cpf]',
        'password'     => 'required|max_length[255]|min_length[6]',
        'pass_confirmation' => 'required_with[password]|max_length[255]|matches[password]',
    ];
    protected $validationMessages = [
        'nome' => [
            'required' => 'Esse campo é obrigatório.',

        ],
        'email' => [
            'is_unique' => 'Desculpe. Esse email já está cadastrado.',
            'required' => 'Esse campo é obrigatório.',

        ],
        'cpf' => [
            'is_unique' => 'Desculpe. Esse CPF já está cadastrado.',
            'required' => 'Esse campo é obrigatório.',

        ]
    ];


    public function procurar($term){
        if($term === null){
            return [];
        }

        return $this->select(['id', 'nome'])
        ->like('nome', $term)
        ->get()
        ->getResult();
    }

    public function desabilitaValidacaoSenha(){
        unset($this->validationRules['password']);
        unset($this->validationRules['password_confirmation']);
    }
 
}
