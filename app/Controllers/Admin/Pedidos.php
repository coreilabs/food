<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Pedidos extends BaseController
{
    private $pedidoModel;

    public function __construct(){
        $this->pedidoModel = new \App\Models\PedidoModel();
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
}
