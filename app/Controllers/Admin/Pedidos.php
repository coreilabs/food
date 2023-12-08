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
    public function procurar(){

        if(!$this->request->isAJAX()){
            exit('Página não encontrada');
    
        }
    
        $pedidos = $this->pedidoModel->procurar($this->request->getGet('term'));
    
        $retorno = [];
    
        foreach($pedidos as $pedido){
            
            $data['value'] = $pedido->codigo;
    
            $retorno[] = $data;
        }
    
        return $this->response->setJSON($retorno);
    
    }
    public function show($codigoPedido = null)
    {
        $pedido = $this->pedidoModel->buscaPedidoOu404($codigoPedido);

      
        $data = [
            'titulo' => "Detalhando o Pedido $pedido->codigo",
            'pedido' => $pedido,

        ];

        return view('Admin/Pedidos/show', $data);
    }
    public function editar($codigoPedido = null)
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

    public function atualizar($codigoPedido = null){
        if($this->request->getMethod() == 'post'){


            $pedido = $this->pedidoModel->buscaPedidoOu404($codigoPedido);

            if($pedido->situacao == 2){

                return redirect()->back()->with('info','Esse pedido já foi entregue, não pode ser editado');

             
    
            }
            if($pedido->situacao == 3){
    
                return redirect()->back()->with('info','Esse pedido foi cancelado, não pode ser editado');
    
            }


            $pedidoPost = $this->request->getPost();

            if(!isset($pedidoPost['situacao'])){

                return redirect()->back()->with('atencao', 'Escolha a Situação do Pedido');    

            }
            if($pedidoPost['situacao'] == 1){

                if(strlen($pedidoPost['entregador_id']) < 1){
                    
                    return redirect()->back()->with('atencao', 'Selecione o Entregador');   

                }
 

            }
            if($pedido->situacao == 0){

                if($pedidoPost['situacao'] == 2){
                    
                    return redirect()->back()->with('atencao', 'O pedido ainda não saiu para a entrega');   

                }
 

            }

            if($pedidoPost['situacao'] != 1){

              unset($pedidoPost['entregador_id']);

            }
            if($pedidoPost['situacao'] == 3){

              $pedidoPost['entregador_id'] = null;

            }

            //usaremos para avisar o admin que o pedido foi cancelado (ligar entregador)
            $situacaoAnteriorPedido = $pedido->situacao;

            $pedido->fill($pedidoPost);

            if(!$pedido->hasChanged()){
                return redirect()->back()->with('info', 'Nada alterado');  
            }


            if($this->pedidoModel->save($pedido)){

                if($pedido->situacao == 1){

                    $entregador = $this->entregadorModel->find($pedido->entregador_id);

                    $pedido->entregador = $entregador;

                    $this->enviaEmailPedidoSaiuEntrega($pedido);

                }
                if($pedido->situacao == 2){

                    $this->enviaEmailPedidoFoiEntregue($pedido);

                    $this->insereProdutosDoPedido($pedido);

                }
                if($pedido->situacao == 3){

                    $this->enviaEmailPedidoFoiCancelado($pedido);

                    if($situacaoAnteriorPedido == 1){

                        session()->setFlashdata('atencao', 'Administrador, este pedido já saiu para entrega. Entre em contato com o entregador.');

                    }

                }

                return redirect()->to(site_url("admin/pedidos/show/$codigoPedido"))->with('sucesso', 'O pedido foi atualizado com sucesso');  

            }else{
                return redirect()->back()->with('errors_model', $this->pedidoModel->errors())->with('atencao', 'Por favor verifique os erros abaixo.');

            }
          
            

        }else{
            return redirect()->back();
        }

    }

    public function excluir($codigoPedido = null)
    {
        $pedido = $this->pedidoModel->buscaPedidoOu404($codigoPedido);

        if($pedido->situacao < 2){

            return redirect()->back()->with('info', 'Apenas Pedidos <strong>Entregues ou Cancelados</strong> podem ser excluídos');


        }

        if($this->request->getMethod() == 'post'){

            $this->pedidoModel->delete($pedido->id);

            return redirect()->to(site_url('admin/pedidos'))->with('sucesso', 'O pedido foi excluído com sucesso');

        }

      
        $data = [
            'titulo' => "Exxcluindo o Pedido $pedido->codigo",
            'pedido' => $pedido,

        ];

        return view('Admin/Pedidos/excluir', $data);
    }

    private function enviaEmailPedidoSaiuEntrega(object $pedido){

        
        $email = service('email');

        $email->setFrom('eldedodeouro@gmail.com', 'Delivery');
        $email->setTo($pedido->email);

        

        
        $email->setSubject("Pedido $pedido->codigo saiu para entrega");


        $mensagem = view('Admin/Pedidos/pedido_saiu_entrega_email', ['pedido' => $pedido]);


        $email->setMessage($mensagem);
        
        $email->send();
    }
    private function enviaEmailPedidoFoiEntregue(object $pedido){

        
        $email = service('email');

        $email->setFrom('eldedodeouro@gmail.com', 'Delivery');
        $email->setTo($pedido->email);

        

        
        $email->setSubject("Pedido $pedido->codigo foi entregue");


        $mensagem = view('Admin/Pedidos/pedido_foi_entregue_email', ['pedido' => $pedido]);


        $email->setMessage($mensagem);
        
        $email->send();
    }
    private function enviaEmailPedidoFoiCancelado(object $pedido){

        
        $email = service('email');

        $email->setFrom('eldedodeouro@gmail.com', 'Delivery');
        $email->setTo($pedido->email);

        

        
        $email->setSubject("Pedido $pedido->codigo foi cancelado");


        $mensagem = view('Admin/Pedidos/pedido_foi_cancelado_email', ['pedido' => $pedido]);


        $email->setMessage($mensagem);
        
        $email->send();
    }

    private function insereProdutosDoPedido(object $pedido){

        $pedidoProdutoModel = new \App\Models\PedidoProdutoModel();

        $produtos = unserialize($pedido->produtos);

        //receberá o push
        $produtosDoPedido = [];

        foreach($produtos as $produto){

            array_push($produtosDoPedido, [
                'pedido_id' => $pedido->id,
                'produto' => $produto['nome'],
                'quantidade' => $produto['quantidade'],
            ]);

        }


        $pedidoProdutoModel->insertBatch($produtosDoPedido);


    }
}
