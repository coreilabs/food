<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Libraries\Token;

class UsuarioModel extends Model
{

    protected $table            = 'usuarios';
    protected $returnType       = 'App\Entities\Usuario';
    protected $allowedFields    = ['nome', 'email', 'cpf', 'reset_hash', 'reset_expira_em', 'telefone', 'password', 'ativacao_hash'];

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
            'is_unique' => 'Desculpe. Esse EMAIL já está cadastrado.',
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



/**
 * @uso Controller usuarios no metodo procurar com o autocomplete
 * @param string $term
 * @return array usuarios
 */
    public function procurar($term){
        if($term === null){
            return [];
        }

        return $this->select(['id', 'nome'])
        ->like('nome', $term)
        ->withDeleted(true)
        ->get()
        ->getResult();
    }

    public function desabilitaValidacaoSenha(){
        unset($this->validationRules['password']);
        unset($this->validationRules['password_confirmation']);
    }

    public function desabilitaValidacaoTelefone(){
        unset($this->validationRules['telefone']);

    }

    public function desfazerExclusao(int $id){
        return $this->protect(false)
        ->where('id', $id)
        ->set('deletado_em', null)
        ->update();
    }

    /**
    * @uso Classe Autenticacao
    * @param string $email
    * @return objeto $usuario
    */

    public function buscaUsuarioPorEmail(string $email){
        return $this->where('email', $email)->first();
    }
 
    public function buscaUsuarioParaResetarSenha(string $token){

    $token = new Token($token);
    $tokenHash = $token->getHash();

    $usuario = $this->where('reset_hash', $tokenHash)->first();
    if($usuario != null){

        //verificamos se o token nao esta expirado de acordo com a data e hora atuais

        if($usuario->reset_expira_em < date('Y-m-d H:i:s')){

            //usuario expirado setamos $usuario = null
            $usuario = null;
        }

        return $usuario;

    }
    }
}
