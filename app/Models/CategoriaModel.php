<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoriaModel extends Model
{
    protected $table            = 'categorias';
    protected $returnType       = 'App\Entities\Categoria';
    protected $useSoftDeletes   = true;
    protected $allowedFields    = ['nome', 'ativo', 'slug'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'criado_em';
    protected $updatedField  = 'atualizado_em';
    protected $deletedField  = 'deletado_em';



    //Validações
    protected $validationRules = [
        'nome'     => 'required|min_length[2]|max_length[120]|is_unique[categorias.nome,id,{id}]',
        'id'    => 'max_length[19]',
    ];
    protected $validationMessages = [
        'nome' => [
            'required' => 'O campo NOME é obrigatório.',
            'is_unique' => 'Esta categoria já está cadastrada.'

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


    public function BuscaCategoriasWebHome(){

        return $this->select('categorias.id, categorias.nome, categorias.slug')->join('produtos', 'produtos.categoria_id = categorias.id')->groupBy('categorias.id')->findAll();

    }


}
