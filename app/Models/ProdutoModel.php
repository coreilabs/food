<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdutoModel extends Model
{
    protected $table            = 'produtos';
    protected $returnType       = 'App\Entities\Produto';
    protected $useSoftDeletes   = true;
    protected $allowedFields    = ['categoria_id', 'nome', 'slug', 'ingredientes', 'ativo', 'imagem' ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'criado_em';
    protected $updatedField  = 'atualizado_em';
    protected $deletedField  = 'deletado_em';


    //Validações
    protected $validationRules = [
        'nome'     => 'required|min_length[2]|max_length[120]|is_unique[produtos.nome]',
        'categoria_id'     => 'required|integer',
        'ingredientes'     => 'required|min_length[10]|max_length[1000]',

    ];
    protected $validationMessages = [
        'nome' => [
            'required' => 'O campo NOME é obrigatório.',
            'is_unique' => 'Este produto já está cadastrado.'

        ],
        'categoria_id' => [
            'required' => 'O campo CATEGORIA é obrigatório.',

        ],
        'ingredientes' => [
            'required' => 'O campo INGREDIENTES é obrigatório.',
            

        ],
    ];

    protected $beforeInsert = ['criaSlug'];
    protected $beforeUpdate = ['criaSlug'];

    protected function criaSlug(array $data){
        if (isset($data['data']['nome'])){
            $data['data']['slug'] = mb_url_title($data['data']['nome'], '-', true);


        }

     
        return $data;
    }



    /**
 * @uso Controller Categorias no metodo procurar com o autocomplete
 * @param string $term
 * @return array categorias
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
