<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Checkout extends BaseController
{

    private $usuario;
    private $formaPagamentoModel;
    private $bairroModel;
    private $pedidoModel;

    public function __construct(){
        $this->usuario = service("autenticacao")->pegaUsuarioLogado();
        $this->formaPagamentoModel = new \App\Models\FormaPagamentoModel();
        $this->bairroModel = new \App\Models\BairroModel();
        $this->pedidoModel = new \App\Models\PedidoModel();
    }
    public function index()
    {
        if(!session()->has('carrinho') || count(session()->get('carrinho')) < 1){

            return redirect()->to(site_url('carrinho'));
 
        }

        $data = [
            'titulo' => 'Finalizar Pedido',
            'carrinho' => session()->get('carrinho'),
            'formas' => $this->formaPagamentoModel->where('ativo', true)->findAll(),

        ];

        return view('Checkout/index', $data);
    }

    public function consultaCep(){
        if(!$this->request->isAJAX()){

            return redirect()->to(site_url('/'));            

        }
        $validacao = service('validation');
        $validacao->setRule('cep', 'CEP', 'required|exact_length[9]');

        if(!$validacao->withRequest($this->request)->run()){

            $retorno['erro'] = '<span class="text-danger small">'. $validacao->getError().'</span>';
            return $this->response->setJSON($retorno);

        }

        $cep = str_replace("-", '', $this->request->getGet('cep'));

        // carregamos o helper
        helper('consulta_cep');

        $consulta = consultaCep($cep);

        
        if(isset($consulta->erro) && !isset($consulta->cep)){

            $retorno['erro'] = '<span class="text-danger">Informe um CEP válido</span>';

            return $this->response->setJSON($retorno);

        }

        $bairroRetornoSlug = mb_url_title($consulta->bairro, '-', true);
        $bairro = $this->bairroModel->select('nome, valor_entrega, slug')->where('slug', $bairroRetornoSlug)->where('ativo', true)->first();

        if($consulta->bairro == null || $bairro == null){

            $retorno['erro'] = '<span class="text-danger small">Não atendemos o Bairro: '.esc($consulta->bairro)
            .' - '.esc($consulta->localidade)
            .' - '.esc($consulta->uf).'</span>'
            .' - CEP '.esc($consulta->cep);

            return $this->response->setJSON($retorno);
        }

  
        $retorno['valor_entrega'] = 'R$ '. esc(number_format($bairro->valor_entrega, 2,',','.'));

        $retorno['bairro'] = '<span class="text-danger">Valor de entrega para o Bairro: '.esc($consulta->bairro)
        .' - '.esc($consulta->localidade)
        .' - '.esc($consulta->uf)
        .' - CEP '.esc($consulta->cep) 
        .' - R$ '.esc(number_format($bairro->valor_entrega, 2))
        .'</span>';

        $retorno['endereco'] = esc($consulta->bairro)
        .' - '.esc($consulta->localidade)
        .' - '.esc($consulta->logradouro)
        .' - '.esc($consulta->uf)
        .' - CEP '.esc($consulta->cep) 
        .'</span>';


        $retorno['logradouro'] = $consulta->logradouro;
        $retorno['bairro_slug'] = $bairro->slug;
        $retorno['total'] = number_format($this->somaValorProdutosCarrinho() + $bairro->valor_entrega,2,',','.');

        session()->set('endereco_entrega', $retorno['endereco']);

        return $this->response->setJSON($retorno);

 
    }

    public function processar(){
        if($this->request->getMethod() == 'post'){

            $checkoutPost = $this->request->getPost('checkout');

            $validacao = service('validation');

            $validacao->setRules([
                'checkout.rua' => ['label' => 'Endereço', 'rules' => 'required|max_length[50]'],
                'checkout.numero' => ['label' => 'Número', 'rules' => 'required|max_length[30]'],
                'checkout.referencia' => ['label' => 'Ponto de Referência', 'rules' => 'required|max_length[50]'],
                'checkout.forma_id' => ['label' => 'Forma de Pagamento', 'rules' => 'required|integer'],
                'checkout.bairro_slug' => ['label' => 'Consulte a Taxa de Entrega', 'rules' => 'required|string|max_length[30]'],
           ]);

            if(!$validacao->withRequest($this->request)->run()){

                session()->remove('endereco_entrega'); 
                return redirect()->back()->with('errors_model', $validacao->getErrors())->with('atencao', 'Por favor verifique os erros abaixo e tente novamente.');
            }

            $forma = $this->formaPagamentoModel->where('id', $checkoutPost['forma_id'])->where('ativo', true)->first();

            if($forma == null){

                session()->remove('endereco_entrega'); 
                return redirect()->back()->with('errors_model', $validacao->getErrors())->with('atencao', 'Por favor escolha a <strong>Forma de Pagamento </strong> e tente novamente');
            }

            $bairro = $this->bairroModel->where('slug', $checkoutPost['bairro_slug'])->where('ativo', true)->first();

  

            if($bairro == null){

                session()->remove('endereco_entrega'); 
                return redirect()->back()->with('errors_model', $validacao->getErrors())->with('atencao', 'Por favor informe seu <strong>CEP</strong> e calcule a taxa de entrega novamente');
            }

            if(!session()->get('endereco_entrega')){

                return redirect()->back()->with('errors_model', $validacao->getErrors())->with('atencao', 'Por favor informe seu <strong>CEP</strong> e calcule a taxa de entrega novamente');

            }

            //já podemos salvar o pedido

         
            $pedido = new \App\Entities\Pedido();


            $pedido->usuario_id = $this->usuario->id;
            $pedido->codigo = $this->pedidoModel->geraCodigoPedido();
            $pedido->forma_pagamento = $forma->nome;
            $pedido->produtos = serialize(session()->get('carrinho'));
            $pedido->valor_produtos = number_format($this->somaValorProdutosCarrinho(), 2);
            $pedido->valor_entrega = number_format($bairro->valor_entrega, 2);
            $pedido->valor_pedido = number_format($pedido->valor_produtos + $pedido->valor_entrega, 2);
            $pedido->endereco_entrega = session()->get('endereco_entrega').' - Número '. $checkoutPost['numero'];


            if($forma->id == 1){

                if(isset($checkoutPost['sem_troco'])){

                    $pedido->observacoes = 'Ponto de Referência: ' . $checkoutPost['referencia'] . ' - Número: ' . $checkoutPost['numero'] . '. Você informou que não precisa de troco.';
                
                }

                if(isset($checkoutPost['troco_para'])){
                    $trocoPara = str_replace(',', '', $checkoutPost['troco_para']);
                    $pedido->observacoes = 'Ponto de Referência: ' . $checkoutPost['referencia'] . ' - Número: ' . $checkoutPost['numero'] . '. Você informou que precisa de troco para: R$ ' . number_format($trocoPara, 2, ',', '.');


                }

            }else{ 

                //cliente escolheu forma de pagamento diferente de dinheiro
                $pedido->observacoes = 'Ponto de Referência: ' . $checkoutPost['referencia'] . ' - Número: ' . $checkoutPost['numero'];

            }

            echo "<pre>";
            print_r($pedido);
            exit;




        }else{
            return redirect()->back();
        }
    }

    //funções privadas
    private function somaValorProdutosCarrinho(){
        $produtosCarrinho = array_map(function ($linha) {

            return $linha['quantidade'] * $linha['preco'];

        }, session()->get('carrinho'));

        return array_sum($produtosCarrinho);

    }
}
