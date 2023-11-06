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
            'nome'     => 'required|min_length[2]|max_length[120]|is_unique[medidas.nome]',
        ];
        protected $validationMessages = [
            'nome' => [
                'required' => 'O campo NOME é obrigatório.',
                'is_unique' => 'Esta Medida já está cadastrada.'
    
            ],
        ];

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

   
}
