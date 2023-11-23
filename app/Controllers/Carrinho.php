<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Carrinho extends BaseController{

    private $validacao;
    private $produtoEspecificacaoModel;
    
    public function __construct(){
        
        $this->validacao = service('validation');
        $this->produtoEspecificacaoModel = new \App\Models\ProdutoEspecificacaoModel();
    }
    public function index()
    {
        //
    }

    public function adicionar(){
        if($this->request->getMethod() === 'post'){

            $produtoPost = $this->request->getPost();
           


            $this->validacao->setRules([
                'produto.slug' => ['label' => 'Produto', 'rules' => 'required|string'],
                'produto.especificacao_id' => ['label' => 'Valor do Produto', 'rules' => 'required|greater_than[0]'],
                'produto.preco' => ['label' => 'Valor do Produto', 'rules' => 'required|greater_than[0]'],
                'produto.quantidade' => ['label' => 'Quantidade', 'rules' => 'required|greater_than[0]'],

               
            ]);

            if(!$this->validacao->withRequest($this->request)->run()){
                return redirect()->back()->with('errors_model', $this->validacao->getErrors())->with('atencao', 'Por favor verifique os erros abaixo e tente novamente.')->withInput();
            }

            //validamos a existencia da especificacao_id
            $especificacaoProduto = $this->produtoEspecificacaoModel->where('id', $produtoPost['especificacao_id'])->first();

            dd($especificacaoProduto);

        }else{
            return redirect()->back();
        }
    }
}
