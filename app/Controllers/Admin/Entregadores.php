<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use App\Entities\Entregador;

class Entregadores extends BaseController
{

    private $entregadorModel;

    public function __construct(){
        $this->entregadorModel = new \App\Models\EntregadorModel();
    }
    public function index()
    {
        $data = [
            'titulo' => 'Listando os entregadores',
            'entregadores' => $this->entregadorModel->withDeleted(true)->paginate(10),
            'pager' => $this->entregadorModel->pager,
        ];

        return view('Admin/Entregadores/index', $data);
    }

    public function procurar(){

        if(!$this->request->isAJAX()){
            exit('Página não encontrada');
    
        }
    
        $entregadores = $this->entregadorModel->procurar($this->request->getGet('term'));
    
        $retorno = [];
    
        foreach($entregadores as $entregador){
            $data['id'] = $entregador->id;
            $data['value'] = $entregador->nome;
    
            $retorno[] = $data;
        }
    
        return $this->response->setJSON($retorno);
    
    }

    public function criar(){
        $entregador = new Entregador();


        
        $data = [
            'titulo' => "Cadastrando entregador",
            'entregador' => $entregador,
        ];

        return view('Admin/Entregadores/criar', $data);
    }

    public function cadastrar(){
        if($this->request->getMethod() === 'post'){
            $entregador = new Entregador($this->request->getPost());

            // dd($this->request->getPost());


            if($this->entregadorModel->save($entregador)){
                return redirect()->to(site_url("admin/entregadores/show/".$this->entregadorModel->getInsertID()))
                ->with('sucesso', "Entregador $entregador->nome cadastrado com sucesso.");
            }else{
                return redirect()->back()->with('errors_model', $this->entregadorModel->errors())->with('atencao', 'Por favor verifique os erros abaixo.')->withInput();
            }
    

        }else{
            return redirect()->back();
        }
    }

    public function editar($id = null){
        $entregador = $this->buscaEntregadorOu404($id);


        
        $data = [
            'titulo' => "Editando o entregador $entregador->nome",
            'entregador' => $entregador,
        ];

        return view('Admin/Entregadores/editar', $data);
    }

    public function atualizar($id = null){
        if($this->request->getMethod() === 'post'){
            $entregador = $this->buscaEntregadorOu404($id);
            // dd($this->request->getPost());

            $entregador->fill($this->request->getPost());

            if(!$entregador->hasChanged()){

                return redirect()->back()->with('info', 'Não há dados para atualizar');

            }

            if($this->entregadorModel->save($entregador)){
                return redirect()->to(site_url("admin/entregadores/show/$entregador->id"))
                ->with('sucesso', "Entregador $entregador->nome atualizado com sucesso.");
            }else{
                return redirect()->back()->with('errors_model', $this->entregadorModel->errors())->with('atencao', 'Por favor verifique os erros abaixo.')->withInput();
            }
    

        }else{
            return redirect()->back();
        }
    }

    public function show($id = null){
        $entregador = $this->buscaEntregadorOu404($id);


        
        $data = [
            'titulo' => "Detalhando o entregador $entregador->nome",
            'entregador' => $entregador,
        ];

        return view('Admin/Entregadores/show', $data);
    }

    /**
 * @param int $id
 * @return objeto entregador
 */


private function buscaEntregadorOu404(int $id = null){
    if(!$id || !$entregador = $this->entregadorModel->withDeleted(true)->where('id', $id)->first()){
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Não Encontramos o entregador $id");
    }
    return $entregador;
}
}
