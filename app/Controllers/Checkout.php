<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Checkout extends BaseController
{

    private $usuario;
    private $formaPagamentoModel;
    private $bairroModel;

    public function __construct(){
        $this->usuario = service("autenticacao")->pegaUsuarioLogado();
        $this->formaPagamentoModel = new \App\Models\FormaPagamentoModel();
        $this->bairroModel = new \App\Models\BairroModel();
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
                return redirect()->back()->with('errors_model', $validacao->getErrors())->with('atencao', 'Por favor verifique os erros abaixo e tente novamente.')->withInput();
            }

            print_r($this->request->getPost());

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
