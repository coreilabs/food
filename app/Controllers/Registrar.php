<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Registrar extends BaseController
{

    private $usuarioModel;

    public function __construct(){
        $this->usuarioModel = new \App\Models\UsuarioModel();
    }

    public function novo()
    {
        //

        $data = [
            'titulo' => 'Criar nova conta',
        ];

        return view('Registrar/novo', $data);
    }

    public function criar(){
        if($this->request->getMethod() === 'post'){

            $usuario = new \App\Entities\Usuario($this->request->getPost());

            $this->usuarioModel->desabilitaValidacaoTelefone();
            
            if($this->usuarioModel->insert($usuario)){

                echo 'Conta Criada';
                exit;

            }else {
               
                
                if($this->usuarioModel->protect(false)->save($usuario)){
                    return redirect()->to(site_url("admin/usuarios/show/".$this->usuarioModel->getInsertID()))
                    ->with('sucesso', "Usuário $usuario->nome cadastrado com sucesso.");
                }else{
                    return redirect()->back()->with('errors_model', $this->usuarioModel->errors())->with('atencao', 'Por favor verifique os erros abaixo.')->withInput();
                }


            }
    
        }else{
            return redirect()->back();
        }
    }

}
