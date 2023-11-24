<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Carrinho extends BaseController{

    private $validacao;
    private $produtoEspecificacaoModel;
    private $extraModel;
    private $produtoModel;

    
    public function __construct(){
        
        $this->validacao = service('validation');
        $this->produtoEspecificacaoModel = new \App\Models\ProdutoEspecificacaoModel();
        $this->extraModel = new \App\Models\ExtraModel();
        $this->produtoModel = new \App\Models\ProdutoModel();


    }
    public function index()
    {
        //
    }

    public function adicionar(){
        if($this->request->getMethod() === 'post'){

            $produtoPost = $this->request->getPost('produto');
           
          


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

         

            //fraude no form
            if($especificacaoProduto == null){
                return redirect()->back()->with('fraude', 'Não conseguimos processar a sua solicitação. Por favor entre em contato com a nossa equipe e informe o código de erro <strong>ERRO-ADD-PROD-1001</strong> ');
            }

            /**
             * caso o extra_id venha no post, validamos a existencia do mesmo
             */

            if($produtoPost['extra_id'] && $produtoPost['extra_id'] != ""){

                $extra = $this->extraModel->where('id', $produtoPost['extra_id'])->first();

                //fraude  $produtoPost['extra_id']
                if($extra == null){
                    return redirect()->back()->with('fraude', 'Não conseguimos processar a sua solicitação. Por favor entre em contato com a nossa equipe e informe o código de erro <strong>ERRO-ADD-PROD-2002</strong> ');
                }

            }



             $produto = $this->produtoModel->where('slug', $produtoPost['slug'])->first();

            /**
             * validamos a existencia do produto e se o mesmo está ativo
             * fraude no form $produtoPost['slug']
             */
            if($produto == null || $produto->ativo == false){
                return redirect()->back()->with('fraude', 'Não conseguimos processar a sua solicitação. Por favor entre em contato com a nossa equipe e informe o código de erro <strong>ERRO-ADD-PROD-3003</strong> ');
            }

            dd($produtoPost);

        }else{
            return redirect()->back();
        }
    }
}
