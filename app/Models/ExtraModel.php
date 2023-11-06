<?php

namespace App\Models;

use CodeIgniter\Model;

class ExtraModel extends Model
{
    protected $table            = 'extras';
    protected $returnType       = 'App\Entities\Extra';
    protected $useSoftDeletes   = true;
    protected $allowedFields    = ['nome', 'slug', 'preco', 'descricao', 'ativo'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'criado_em';
    protected $updatedField  = 'atualizado_em';
    protected $deletedField  = 'deletado_em';


        //Validações
        protected $validationRules = [
            'nome'     => 'required|min_length[2]|max_length[120]|is_unique[extras.nome]',
        ];
        protected $validationMessages = [
            'nome' => [
                'required' => 'O campo NOME é obrigatório.',
                'is_unique' => 'Este Extra já está cadastrado.'
    
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
 * @uso Controller extras no metodo procurar com o autocomplete
 * @param string $term
 * @return array extras
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
