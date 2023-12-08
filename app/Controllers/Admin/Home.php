<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Home extends BaseController
{

    private $pedidoModel;
    private $usuarioModel;
    private $entregadorModel;

    public function __construct(){
        $this->pedidoModel = new \App\Models\PedidoModel();
        $this->usuarioModel = new \App\Models\UsuarioModel();
        $this->entregadorModel = new \App\Models\EntregadorModel();
    }
    public function index()
    {
        $data = [
            'titulo' => 'Home da Área Restrita',
            'valorPedidosEntregues' => $this->pedidoModel->valorPedidosEntregues(),
            'valorPedidosCancelados' => $this->pedidoModel->valorPedidosCancelados(),
            'totalClientesAtivos' => $this->usuarioModel->recuperaTotalClientesAtivos(),
            'totalEntregadoresAtivos' => $this->entregadorModel->recuperaTotalEntregadoresAtivos(),
        ];
        return view('Admin/Home/index', $data);
    }
}
