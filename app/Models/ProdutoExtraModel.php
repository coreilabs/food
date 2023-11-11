<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdutoExtraModel extends Model
{
    protected $table            = 'produtos_extras';
    protected $returnType       = 'object';
    protected $allowedFields    = ['produto_id', 'extra_id'];

    protected $validationRules = [
        'extra_id'     => 'required|integer',


    ];
    protected $validationMessages = [
        'extra_id' => [
            'required' => 'O campo EXTRA é obrigatório.',

        ],
    ];

}
