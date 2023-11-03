<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{

    protected $table            = 'usuarios';
    protected $returnType       = 'App\Entities\Usuario';
    protected $allowedFields    = ['nome', 'email', 'telefone'];

    //Datas
    protected $useTimestamps        = true;
    protected $createdField         = 'criado_em'; // Nome da coluna no banco de dados
    protected $updatedField         = 'atualizado_em'; // Nome da coluna no banco de dados
    protected $dateFormat         = 'datetime'; // Para uso com $useSoftDelete
    protected $useSoftDeletes   = true;    
    protected $deletedField         = 'deletado_em'; // Nome da coluna no banco de dados



    //Validações
    protected $validationRules = [
        'nome'     => 'required|max_length[120]|alpha_numeric_space|min_length[3]',
        'email'        => 'required|max_length[254]|min_length[4]|valid_email|is_unique[usuarios.email]',
        'cpf'        => 'required|exact_length[14]|is_unique[usuarios.cpf]|validaCpf',
        'password'     => 'required|max_length[255]|min_length[6]',
        'telefone'     => 'required',
        'password_confirmation' => 'required_with[password]|max_length[255]|matches[password]',
    ];
    protected $validationMessages = [
        'nome' => [
            'required' => 'O campo NOME é obrigatório.',

        ],      
        'telefone' => [
            'required' => 'O campo TELEFONE é obrigatório.',

        ],
        'email' => [
            'is_unique' => 'Desculpe. Esse email já está cadastrado.',
            'required' => 'O campo EMAIL é obrigatório.',

        ],
        'password' => [
            'required' => 'O campo SENHA é obrigatório.',

        ],
        'cpf' => [
            'is_unique' => 'Desculpe. Esse CPF já está cadastrado.',
            'required' => 'O campo CPF é obrigatório.',

        ]
    ];

    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];

    protected function hashPassword(array $data){
        if (isset($data['data']['password'])){
            $data['data']['password_hash'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
            unset($data['data']['password']);
            unset($data['data']['password_confirmation']);

        }

     
        return $data;
    }




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

    public function desfazerExclusao(int $id){
        return $this->protect(false)
        ->where('id', $id)
        ->set('deletado_em', null)
        ->update();
    }
 
}
