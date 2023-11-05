<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Password extends BaseController
{

    private $usuarioModel;
    public function __construct(){
        $this->usuarioModel = new \App\Models\UsuarioModel();
    }
    public function esqueci()
    {
        
        $data = [
            'titulo' => 'Esqueci a senha',
        ];

        return view('Password/esqueci', $data);
    }

    public function processaEsqueci(){

        if($this->request->getMethod() === 'post'){

            $usuario = $this->usuarioModel->buscaUsuarioPorEmail($this->request->getPost('email'));
            if($usuario === null || !$usuario->ativo){
                return redirect()->to(site_url('password/esqueci'))->with('atencao', 'Não encontramos uma conta válida com esse email.')->withInput();


            }

            $usuario->iniciaPasswordReset();

           $this->usuarioModel->save($usuario);


            $this->enviaEmailRedefinicaoSenha($usuario);

            return redirect()->to(site_url('login'))->with('sucesso', 'Email de redefinição de senha enviado para sua caixa de entrada.');


        }else{
            //nao é post
            return redirect()->back();
        }
    }

    private function enviaEmailRedefinicaoSenha(object $usuario){

        
        $email = service('email');

        $email->setFrom('eldedodeouro@gmail.com', 'Delivery');
        $email->setTo($usuario->email);

        

        
        $email->setSubject('Redefinição de Senha');


        $mensagem = view('Password/reset_email', ['token' => $usuario->reset_token]);


        $email->setMessage($mensagem);
        
        $email->send();
    }

}
