<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Pedidos extends BaseController
{
    private $pedidoModel;
    private $entregadorModel;

    public function __construct(){
        $this->pedidoModel = new \App\Models\PedidoModel();
        $this->entregadorModel = new \App\Models\EntregadorModel();
    }
    public function index()
    {
        $data = [
            'titulo' => 'Pedidos Realizados',
            'pedidos' => $this->pedidoModel->listaTodosOsPedidos(),
            'pager' => $this->pedidoModel->pager

        ];

        return view('Admin/Pedidos/index', $data);
    }
    public function show($codigoPedido)
    {
        $pedido = $this->pedidoModel->buscaPedidoOu404($codigoPedido);

      
        $data = [
            'titulo' => "Detalhando o Pedido $pedido->codigo",
            'pedido' => $pedido,

        ];

        return view('Admin/Pedidos/show', $data);
    }
    public function editar($codigoPedido)
    {
        $pedido = $this->pedidoModel->buscaPedidoOu404($codigoPedido);

        if($pedido->situacao == 2){

            return redirect()->back()->with('info','Esse pedido já foi entregue, não pode ser editado');

        }
        if($pedido->situacao == 3){

            return redirect()->back()->with('info','Esse pedido foi cancelado, não pode ser editado');

        }



      
        $data = [
            'titulo' => "Detalhando o Pedido $pedido->codigo",
            'pedido' => $pedido,
            'entregadores' => $this->entregadorModel->select('id, nome')->where('ativo', true)->findAll()

        ];



        return view('Admin/Pedidos/editar', $data);
    }
}
