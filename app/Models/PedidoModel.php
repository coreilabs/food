<?php

namespace App\Models;

use CodeIgniter\Model;

class PedidoModel extends Model
{
    protected $table            = 'pedidos';    
    protected $returnType       = 'App\Entities\Pedido';
    protected $useSoftDeletes   = true;
    protected $allowedFields    = ['usuario_id', 'entregador_id', 'codigo', 'forma_pagamento', 'situacao', 'produtos', 'valor_produtos', 'valor_entrega', 'valor_pedido', 'endereco_entrega', 'observacoes'];

    // Dates
    protected $useTimestamps = true;
    protected $createdField  = 'criado_em';
    protected $updatedField  = 'atualizado_em';
    protected $deletedField  = 'deletado_em';

    public function geraCodigoPedido(){
        do {
            $codigoPedido = random_string('numeric', 8);
            $this->where('codigo', $codigoPedido);
        } while($this->countAllResults() > 1);

        return $codigoPedido;

    }
     /**
      * Summary of listaTodosOsPedidos
      * @return float|int
      * @uso controller Admin\Pedidos
      */

    public function listaTodosOsPedidos(){

        return $this->select(['pedidos.*', 'usuarios.nome AS cliente',])->join('usuarios', 'usuarios.id = pedidos.usuario_id')
            ->orderBy('pedidos.criado_em', 'DESC')
            ->paginate(10);

    }
}
