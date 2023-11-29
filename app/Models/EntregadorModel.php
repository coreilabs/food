<?php

namespace App\Models;

use CodeIgniter\Model;

class EntregadorModel extends Model
{
    protected $table            = 'entregadores';
    protected $returnType       = 'App\Entities\Entregador';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nome',
        'cpf',
        'cnh',
        'email',
        'telefone',
        'imagem',
        'ativo',
        'veiculo',
        'placa',
        'endereco'

    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'criado_em';
    protected $updatedField  = 'atualizado_em';
    protected $deletedField  = 'deletado_em';

    protected $validationRules = [
        'nome'     => 'required|max_length[120]|min_length[4]',
        'email'        => 'required|max_length[254]|min_length[4]|valid_email|is_unique[entregadores.email]',
        'cpf'        => 'required|exact_length[14]|is_unique[entregadores.cpf]|validaCpf',
        'cnh'        => 'required|exact_length[11]|is_unique[entregadores.cnh]|',
        'telefone'        => 'required|exact_length[15]|is_unique[entregadores.telefone]|',
        'endereco'        => 'required|max_length[230]',
        'veiculo'        => 'required|max_length[230]',
        'placa'        => 'required|min_length[7]|max_length[8]|is_unique[entregadores.placa]',




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
        'cnh' => [
            'required' => 'O campo CNH é obrigatório.',

        ],
        'endereco' => [
            'required' => 'O campo ENDEREÇO é obrigatório.',

        ],
        'veiculo' => [
            'required' => 'O campo VEÍCULO é obrigatório.',

        ],
        'placa' => [
            'required' => 'O campo PLACA é obrigatório.',

        ],
        'password' => [
            'required' => 'O campo SENHA é obrigatório.',

        ],
        'cpf' => [
            'is_unique' => 'Desculpe. Esse CPF já está cadastrado.',
            'required' => 'O campo CPF é obrigatório.',

        ]
    ];

    
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


public function desfazerExclusao(int $id){
    return $this->protect(false)
    ->where('id', $id)
    ->set('deletado_em', null)
    ->update();
}


}
