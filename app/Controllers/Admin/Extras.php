<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Entities\Extra;

class Extras extends BaseController
{
    private $extraModel;

    public function __construct(){
        $this->extraModel = new \App\Models\ExtraModel();
    }

    public function index()
    {
       $data = [
        'titulo' => 'Listando os extras de Produtos',
        'extras' => $this->extraModel->withDeleted(true)->paginate(10),
        'pager' => $this->extraModel->pager
       ];

       return view('Admin/Extras/index', $data);
    }

    public function procurar(){

        if(!$this->request->isAJAX()){
            exit('Página não encontrada');
    
        }
    
        $extras = $this->extraModel->procurar($this->request->getGet('term'));
    
        $retorno = [];
    
        foreach($extras as $extra){
            $data['id'] = $extra->id;
            $data['value'] = $extra->nome;
    
            $retorno[] = $data;
        }
    
        return $this->response->setJSON($retorno);
    
    }

    public function show($id = null){

        $extra = $this->buscaExtraOu404($id);
        $data = [
            'titulo' => "Detalhando o $extra->nome",
            'extra' => $extra,
        ]; 
        
        return view('Admin/Extras/show', $data);

    }

    public function editar($id = null){

        $extra = $this->buscaExtraOu404($id);
    
        if($extra->deletado_em != null ){
            return redirect()->back()->with('info',"O extra $extra->nome encontra-se excluído. Não é possível editá-la.");
        }
    
        $data = [
            'titulo' => "Editando o extra $extra->nome",
            'extra' => $extra,
        ]; 
        
        return view('Admin/Extras/editar', $data);
    
    }
    
    
    public function atualizar($id = null){
        if($this->request->getMethod() === 'post'){
            $extra = $this->buscaExtraOu404($id);
    
            if($extra->deletado_em != null ){
                return redirect()->back()->with('info',"A extra $extra->nome encontra-se excluída. Não é possível atualizá-la.");
            }       
    
            $extra->fill($this->request->getPost());
    
            if(!$extra->hasChanged()){
    
                return redirect()->back()->with('info', 'Nada foi alterado.');
    
            }
    
    
            if($this->extraModel->save($extra)){
                return redirect()->to(site_url("admin/extras/show/$extra->id"))
                ->with('sucesso', "Extra $extra->nome atualizada com sucesso.");
            }else{
                return redirect()->back()->with('errors_model', $this->extraModel->errors())->with('atencao', 'Por favor verifique os erros abaixo.')->withInput();
            }
    
    
    
        }else{
            return redirect()->back();
        }
    }

    /**
 * @param int $id
 * @return objeto extra
 */
private function buscaExtraOu404(int $id = null){
    if(!$id || !$extra = $this->extraModel->withDeleted(true)->where('id', $id)->first()){
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Não Encontramos a Extra $id");
    }
    return $extra;
}
}
