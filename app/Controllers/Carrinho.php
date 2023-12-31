<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Carrinho extends BaseController{

    private $validacao;
    private $produtoEspecificacaoModel;
    private $extraModel;
    private $produtoModel;
    private $bairroModel;
    private $medidaModel;
    private $acao;
    private $horaAtual;
    private $expedienteHoje;

    
    public function __construct(){
        
        $this->validacao = service('validation');
        $this->produtoEspecificacaoModel = new \App\Models\ProdutoEspecificacaoModel();
        $this->extraModel = new \App\Models\ExtraModel();
        $this->produtoModel = new \App\Models\ProdutoModel();
        $this->medidaModel = new \App\Models\MedidaModel();
        $this->bairroModel = new \App\Models\BairroModel();
        $this->horaAtual = date('H:i');
  



        $this->acao = service('router')->methodName();


    }
    public function index()
    {
        $data = [
            'titulo' => 'Meu carrinho de compras',
        ];

        if(session()->has('carrinho') && count(session()->get('carrinho')) > 0){

            $data['carrinho'] = json_decode(json_encode(session()->get('carrinho')), false );

        }

        return view('Carrinho/index', $data);
    }

    public function adicionar(){
        if($this->request->getMethod() === 'post'){

            $this->expedienteHoje = expedienteHoje();

            if($this->expedienteHoje->situacao == false){

                return redirect()->back()->with('expediente', 'Estamos Fechados');

            }

            if($this->horaAtual > $this->expedienteHoje->fechamento || $this->horaAtual < $this->expedienteHoje->abertura){

                return redirect()->back()->with('expediente', 'Nosso horário de atendimento para '.$this->expedienteHoje->dia_descricao . ' é de ' . $this->expedienteHoje->abertura . ' às ' . $this->expedienteHoje->fechamento);

            }



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
            $especificacaoProduto = $this->produtoEspecificacaoModel->join('medidas', 'medidas.id = produtos_especificacoes.medida_id')
            ->where('produtos_especificacoes.id', $produtoPost['especificacao_id'])->first();

         

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


            //buscamos o produto como objeto
            $produto = $this->produtoModel->select(['id', 'nome', 'slug', 'ativo'])->where('slug', $produtoPost['slug'])->first();

           

            /**
             * validamos a existencia do produto e se o mesmo está ativo
             * fraude no form $produtoPost['slug']
             */
            if($produto == null || $produto->ativo == false){
                return redirect()->back()->with('fraude', 'Não conseguimos processar a sua solicitação. Por favor entre em contato com a nossa equipe e informe o código de erro <strong>ERRO-ADD-PROD-3003</strong> ');
            }

            //converto o objeto para array
            $produto = $produto->toArray();

            //Criamos o slug composto para identificarmos a existencia ou nao do item no item no carrinho na hora de adicionar
            $produto['slug'] = mb_url_title($produto['slug'] . '-' . $especificacaoProduto->nome . '-' . (isset($extra) ? 'com extra-' . $extra->nome : ''), '-', true);

            //criamos o nome do produto a partir da especificacao e (ou) do extra
            $produto['nome'] = $produto['nome']. ' ' . $especificacaoProduto->nome . ' ' . (isset($extra) ? 'Com extra ' . $extra->nome : '');

            //definimos o preco qtd e tamanho
            $preco = $especificacaoProduto->preco + (isset($extra) ? $extra->preco : 0);

            $produto['preco'] = number_format($preco, 2);
            $produto['quantidade'] = (int) $produtoPost['quantidade'];
            $produto['tamanho'] = $especificacaoProduto->nome;
            
            //removemos atributos sem utilidade
            unset($produto['ativo']);

            //iniciamos a inserção do produto no carrinho

            if(session()->has('carrinho')){

                //existe um carrinho

                //recupero os produtos do carrinho
                $produtos = session()->get('carrinho');

                // recuperamos apenas os slugs
                $produtosSlugs = array_column($produtos, 'slug');

                if(in_array($produto['slug'], $produtosSlugs)){

                    //já existe o produto no carrinho, incrementamos a qtd


                    //chamamos a funcao que incrementa a qtd do produto caso o mesmo exista no carrinho
                    $produtos = $this->atualizaProduto($this->acao, $produto['slug'], $produto['quantidade'], $produtos);
                    
                   //sobreescrevemos a sessao carrinho com o array produtos que foi incrementado
                    session()->set('carrinho', $produtos);

                }else{
                    

                    //não existe no carrinho pode adicionar

                    //adicionamos no carrinho existente o $produto
                    session()->push('carrinho', [$produto]);

                }



            }else{

                //não existe um carrinho
                $produtos[] = $produto;

                session()->set('carrinho', $produtos);

            }

            return redirect()->to(site_url('carrinho'))->with('sucesso', 'Produto adicionado com sucesso!');


        }else{
            return redirect()->back();
        }
    }

    public function especial(){
        if($this->request->getMethod() === 'post'){

            $this->expedienteHoje = expedienteHoje();

            if($this->expedienteHoje->situacao == false){

                return redirect()->back()->with('expediente', 'Estamos Fechados');

            }

            if($this->horaAtual > $this->expedienteHoje->fechamento || $this->horaAtual < $this->expedienteHoje->abertura){

                return redirect()->back()->with('expediente', 'Nosso horário de atendimento para '.$this->expedienteHoje->dia_descricao . ' é de ' . $this->expedienteHoje->abertura . ' às ' . $this->expedienteHoje->fechamento);

            }

            $produtoPost = $this->request->getPost();


            $this->validacao->setRules([
                'primeira_metade' => ['label' => 'Primeiro Produto', 'rules' => 'required|greater_than[0]'],
                'segunda_metade' => ['label' => 'Segundo Produto', 'rules' => 'required|greater_than[0]'],
                'tamanho' => ['label' => 'Tamanho do Produto', 'rules' => 'required|greater_than[0]'],

                
               

               
            ]);

            if(!$this->validacao->withRequest($this->request)->run()){
                return redirect()->back()->with('errors_model', $this->validacao->getErrors())->with('atencao', 'Por favor verifique os erros abaixo e tente novamente.')->withInput();
            }


         
            $primeiroProduto = $this->produtoModel->select(['id', 'nome', 'slug'])->where('id', $produtoPost['primeira_metade'])->first();

            
            if($primeiroProduto == null){
                return redirect()->back()->with('fraude', 'Não conseguimos processar a sua solicitação. Por favor entre em contato com a nossa equipe e informe o código de erro <strong>ERRO-ADD-CUSTOM-1001</strong> ');
            }

            $segundoProduto = $this->produtoModel->select(['id', 'nome', 'slug'])->where('id', $produtoPost['segunda_metade'])->first();

            
            if($segundoProduto == null){
                return redirect()->back()->with('fraude', 'Não conseguimos processar a sua solicitação. Por favor entre em contato com a nossa equipe e informe o código de erro <strong>ERRO-ADD-CUSTOM-2002</strong> ');
            }

            // convertendo os objetos para array
            $primeiroProduto = $primeiroProduto->toArray();
            $segundoProduto = $segundoProduto->toArray();


           
            //caso o extra_id venha no post, validamos a existencia do mesmo
            if($produtoPost['extra_id'] && $produtoPost['extra_id'] != ""){

                $extra = $this->extraModel->where('id', $produtoPost['extra_id'])->first();

                //fraude  $produtoPost['extra_id']
                if($extra == null){
                    return redirect()->back()->with('fraude', 'Não conseguimos processar a sua solicitação. Por favor entre em contato com a nossa equipe e informe o código de erro <strong>ERRO-ADD-CUSTOM-3003</strong> ');
                }

            }

            //recuperamos o valor do produto de acordo com o tamanho escolhido
            $medida = $this->medidaModel->exibeValor($produtoPost['tamanho']);

            if($medida->preco == null){
                return redirect()->back()->with('fraude', 'Não conseguimos processar a sua solicitação. Por favor entre em contato com a nossa equipe e informe o código de erro <strong>ERRO-ADD-CUSTOM-4004</strong> ');
            }

            //Criamos o slug composto para identificarmos a existencia ou nao do item no item no carrinho na hora de adicionar
            $produto['slug'] = mb_url_title($medida->nome .'-metade-'. $primeiroProduto['slug'] . '-metade-' .$segundoProduto['slug']. '-' . (isset($extra) ? 'com extra-' . $extra->nome : ''), '-', true);

            //criamos o nome do produto a partir da especificacao e (ou) do extra

            $produto['nome'] = $medida->nome .' metade '. $primeiroProduto['nome'] . ' metade ' .$segundoProduto['nome']. ' ' . (isset($extra) ? 'Com extra ' . $extra->nome : '');

            

            //definimos o preco qtd e tamanho
            $preco = $medida->preco + (isset($extra) ? $extra->preco : 0);

            $produto['preco'] = number_format($preco, 2);
            $produto['quantidade'] = 1; //sempre sera 1
            $produto['tamanho'] = $medida->nome;

                   if(session()->has('carrinho')){

                //existe um carrinho

                //recupero os produtos do carrinho
                $produtos = session()->get('carrinho');

                // recuperamos apenas os slugs
                $produtosSlugs = array_column($produtos, 'slug');

                if(in_array($produto['slug'], $produtosSlugs)){

                    //já existe o produto no carrinho, incrementamos a qtd


                    //chamamos a funcao que incrementa a qtd do produto caso o mesmo exista no carrinho
                    $produtos = $this->atualizaProduto($this->acao, $produto['slug'], $produto['quantidade'], $produtos);
                    
                   //sobreescrevemos a sessao carrinho com o array produtos que foi incrementado
                    session()->set('carrinho', $produtos);

                }else{
                    

                    //não existe no carrinho pode adicionar

                    //adicionamos no carrinho existente o $produto
                    session()->push('carrinho', [$produto]);

                }



            }else{

                //não existe um carrinho
                $produtos[] = $produto;

                session()->set('carrinho', $produtos);

            }

            return redirect()->to(site_url('carrinho'))->with('sucesso', 'Produto adicionado com sucesso!');
        

        }else{
            return redirect()->back();
        }
    }

    public function atualizar(){
        if($this->request->getMethod() === 'post'){


            $produtoPost = $this->request->getPost('produto');        


            $this->validacao->setRules([
                'produto.slug' => ['label' => 'Produto', 'rules' => 'required|string'],
                'produto.quantidade' => ['label' => 'Quantidade', 'rules' => 'required|greater_than[0]'],
                

               
            ]);

            if(!$this->validacao->withRequest($this->request)->run()){
                return redirect()->back()->with('errors_model', $this->validacao->getErrors())->with('atencao', 'Por favor verifique os erros abaixo e tente novamente.')->withInput();
            }

                //recupero os produtos do carrinho
                $produtos = session()->get('carrinho');

                // recuperamos apenas os slugs
                $produtosSlugs = array_column($produtos, 'slug');

                if(!in_array($produtoPost['slug'], $produtosSlugs)){

                    return redirect()->back()->with('fraude', 'Não conseguimos processar a sua solicitação. Por favor entre em contato com a nossa equipe e informe o código de erro <strong>ERRO-ATUA-PROD-7007</strong> ');

                } else {

                    //Produto validado... atualizamos a qtd do mesmo no carrinho
                    
                    //chamamos a funcao que incrementa a qtd do produto caso o mesmo exista no carrinho
                    $produtos = $this->atualizaProduto($this->acao, $produtoPost['slug'], $produtoPost['quantidade'], $produtos);
                    
                   //sobreescrevemos a sessao carrinho com o array produtos que foi incrementado ou decrementado
                    session()->set('carrinho', $produtos);

                    return redirect()->back()->with('sucesso', 'Quantidade atualizada com sucesso');

                }  

        }else{
            return redirect()->back();
        }
    }

    public function remover(){
        if($this->request->getMethod() === 'post'){


            $produtoPost = $this->request->getPost('produto');        


            $this->validacao->setRules([
                'produto.slug' => ['label' => 'Produto', 'rules' => 'required|string'],
           ]);

            if(!$this->validacao->withRequest($this->request)->run()){
                return redirect()->back()->with('errors_model', $this->validacao->getErrors())->with('atencao', 'Por favor verifique os erros abaixo e tente novamente.')->withInput();
            }

                //recupero os produtos do carrinho
                $produtos = session()->get('carrinho');

                // recuperamos apenas os slugs
                $produtosSlugs = array_column($produtos, 'slug');

                if(!in_array($produtoPost['slug'], $produtosSlugs)){

                    return redirect()->back()->with('fraude', 'Não conseguimos processar a sua solicitação. Por favor entre em contato com a nossa equipe e informe o código de erro <strong>ERRO-ATUA-PROD-7007</strong> ');

                } else {

                    $produtos = $this->removeProduto($produtos, $produtoPost['slug']);

                    //atualizamos o carrinho na sessao com o array $produtos sem o item que foi removido
                    session()->set('carrinho', $produtos);

                    return redirect()->back()->with('sucesso', 'Produto removido do Carrinho');

                }  

        }else{
            return redirect()->back();
        }
    }

    public function limpar(){
        session()->remove('carrinho');
        return redirect()->to(site_url('carrinho'));
    }

    public function consultaCep(){
        if(!$this->request->isAJAX()){

            return redirect()->back();
        }

        $this->validacao->setRule('cep', 'CEP', 'required|exact_length[9]');

        if(!$this->validacao->withRequest($this->request)->run()){
            $retorno['erro'] = '<span class="text-danger">'. $this->validacao->getError() .'</span>';

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
        $bairro = $this->bairroModel->select('nome, valor_entrega')->where('slug', $bairroRetornoSlug)->where('ativo', true)->first();

        if($consulta->bairro == null || $bairro == null){

            $retorno['erro'] = '<span class="text-danger small">Não atendemos o Bairro: '.esc($consulta->bairro)
            .' - '.esc($consulta->localidade)
            .' - '.esc($consulta->uf).'</span>'
            .' - CEP '.esc($consulta->cep);

            return $this->response->setJSON($retorno);
        }

        $retorno['valor_entrega'] = 'R$ '. esc(number_format($bairro->valor_entrega, 2));

        $retorno['bairro'] = '<span class="text-danger">Valor de entrega para o Bairro: '.esc($consulta->bairro)
        .' - '.esc($consulta->localidade)
        .' - '.esc($consulta->uf)
        .' - CEP '.esc($consulta->cep) 
        .' - R$ '.esc(number_format($bairro->valor_entrega, 2))
        .'</span>';

        $carrinho = session()->get('carrinho');
        $total = 0;

        foreach ($carrinho as $produto){

            $total += $produto['preco'] * $produto['quantidade'];
        }

        $total += esc(number_format($bairro->valor_entrega,2));

        $retorno['total'] = 'R$ ' . esc(number_format($total, 2));
        return $this->response->setJSON($retorno);



    }



    /**
     * @param string $acao
     * @param string $slug
     * @param int $quantidade
     * @param array $produtos
     * @return array
     */
    private function atualizaProduto(string $acao, string $slug, int $quantidade, array $produtos){

        $produtos = array_map(function($linha) use ($acao, $slug, $quantidade){

            if($linha['slug'] == $slug){

                if($acao === 'adicionar'){
                    $linha['quantidade'] += $quantidade;
                }

                if($acao === 'especial'){
                    $linha['quantidade'] += $quantidade;
                }

                if($acao === 'atualizar'){
                     $linha['quantidade'] = $quantidade;

                }

                

            }

            return $linha;
    }, $produtos);

    return $produtos;

    }

    private function removeProduto(array $produtos, string $slug){

        return array_filter($produtos, function($linha) use($slug){

            return $linha['slug'] != $slug;

        });

    }


}
