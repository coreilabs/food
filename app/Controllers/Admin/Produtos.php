<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Entities\Produto;

class Produtos extends BaseController
{
    private $produtoModel;

    public function __construct(){
        $this->produtoModel = new \App\Models\ProdutoModel();
    }
    public function index()
    {
        
        $data = [
            'titulo' => 'Listando os produtos',
            'produtos' => $this->produtoModel->select('produtos.*, categorias.nome AS categoria')
                                            ->join('categorias', 'categorias.id = produtos.categoria_id')
                                            ->withDeleted(true)->paginate(10),
            'pager' => $this->produtoModel->pager,
        ];

        return view('Admin/Produtos/index', $data);



    }

    public function procurar(){

        if(!$this->request->isAJAX()){
            exit('Página não encontrada');
    
        }
    
        $produtos = $this->produtoModel->procurar($this->request->getGet('term'));
    
        $retorno = [];
    
        foreach($produtos as $produto){
            $data['id'] = $produto->id;
            $data['value'] = $produto->nome;
    
            $retorno[] = $data;
        }
    
        return $this->response->setJSON($retorno);
    
    }

    public function show($id = null){

        $produto = $this->buscaProdutoOu404($id);
        $data = [
            'titulo' => "Detalhando o $produto->nome",
            'produto' => $produto,
        ]; 
        
        return view('Admin/Produtos/show', $data);

    }

        /**
 * @param int $id
 * @return objeto produto
 */
private function buscaProdutoOu404(int $id = null){
    if(!$id || !$produto = $this->produtoModel->select('produtos.*, categorias.nome AS categoria')
    ->join('categorias', 'categorias.id = produtos.categoria_id')
    ->withDeleted(true)
    ->first()){
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Não Encontramos o Produto $id");
    }
    return $produto;
}

}
