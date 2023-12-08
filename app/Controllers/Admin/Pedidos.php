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


            dd($pedidoPost);

        }else{
            return redirect()->back();
        }

    }
}
