<?php

namespace App\Controllers;

class Home extends BaseController
{

    private $categoriaModel;
    private $produtoModel;


    public function __construct(){
        $this->categoriaModel = new \App\Models\CategoriaModel();
        $this->produtoModel = new \App\Models\ProdutoModel();

    }
    public function index(): string
    {

       
        // dd($this->expedienteHoje);
        $data = [
            'titulo' => 'Seja muito bem vindo!',
            'categorias' => $this->categoriaModel->BuscaCategoriasWebHome(),
            'produtos' => $this->produtoModel->buscaProdutosWebHome(),
            'expedienteHoje' => expedienteHoje()
        ];
        return view('Home/index', $data);
    }

}
