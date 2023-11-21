<?php

namespace App\Models;

use CodeIgniter\Model;

class ExpedienteModel extends Model
{
    protected $table            = 'expediente';
    protected $returnType       = 'object';
    protected $allowedFields    = ['abertura', 'fechamento', 'situacao'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';




            //Validações
            protected $validationRules = [
                'abertura'     => 'required',
                'fechamento'     => 'required',
    
            ];
            protected $validationMessages = [
                'abertura' => [
                    'required' => 'A ABERTURA é obrigatória.',
                  
        
                ],
                'fechamento' => [
                    'required' => 'O FECHAMENTO é obrigatório.',
                        
                ],
            ];
}
