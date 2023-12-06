<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Checkout extends BaseController
{

    private $usuario;

    public function __construct(){
        $this->usuario = service("autenticacao")->pegaUsuarioLogado();
    }
    public function index()
    {
        if(!session()->has('carrinho') || count(session()->get('carrinho')) < 1){

            return redirect()->to(site_url('carrinho'));
 
        }

        $data = [
            'titulo' => 'Finalizar Pedido',
            'carrinho' => session()->get('carrinho')

        ];

        return view('Checkout/index', $data);
    }
}
