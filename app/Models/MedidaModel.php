<?php

namespace App\Models;

use CodeIgniter\Model;

class MedidaModel extends Model
{
    protected $table            = 'medidas';
    protected $returnType       = 'App\Entities\Medida';
    protected $useSoftDeletes   = true;
    protected $allowedFields    = ['nome', 'descricao', 'ativo'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'criado_em';
    protected $updatedField  = 'atualizado_em';
    protected $deletedField  = 'deletado_em';


        //Validações
        protected $validationRules = [
            'nome'     => 'required|min_length[2]|max_length[120]|is_unique[medidas.nome,id,{id}]',
            'id'    => 'max_length[19]',
        ];
        protected $validationMessages = [
            'nome' => [
                'required' => 'O campo NOME é obrigatório.',
                'is_unique' => 'Esta Medida já está cadastrada.'
    
            ],
        ];

    /**
 * @uso Controller extras no metodo procurar com o autocomplete
 * @param string $term
 * @return array medidas
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

/**
 * @uso controller Produto/exibeValor
 * @param int $medida_id
 * @return objeto contendo maior valor
 */
public function exibeValor(int $medida_id){

    return $this->selectMax('produtos_especificacoes.preco')->join('produtos_especificacoes', 'produtos_especificacoes.medida_id = medidas.id')
    ->where('medidas.id', $medida_id)
    ->where('medidas.ativo', true)
    ->first();


}

   
}
