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

    public function reset($token = null){
        if($token === null){

            return redirect()->to(site_url('password/esqueci'))->with('atencao', 'Link inválido ou expirado.');

        }

        $usuario = $this->usuarioModel->buscaUsuarioParaResetarSenha($token);

        if($usuario != null){
            
            $data = [
                'titulo' => 'Redefina a sua senha',
                'token' => $token,
            ];
            return view('Password/reset', $data);

        }else{

            return redirect()->to(site_url('password/esqueci'))->with('atencao', 'Link inválido ou expirado');
        }

    }

    public function processareset($token = null){

        if($token === null){

            return redirect()->to(site_url('password/esqueci'))->with('atencao', 'Link inválido ou expirado.');

        }

        $usuario = $this->usuarioModel->buscaUsuarioParaResetarSenha($token);

        if($usuario != null){
            
            $usuario->fill($this->request->getPost());

            if($this->usuarioModel->save($usuario)){


                //setammos as colunas 'reset_hash' e 'reset_expira_em' como null ao invocar o metodo abaixo
                //que foi definido na entidade Usuario
                //invalidamos o link antigo que foi enviado para o email do usuario
                $usuario->completaPasswordReset();

                //atualizamos novamente o usuario com os novos valores definidos acima

                $this->usuarioModel->save($usuario);

                return redirect()->to(site_url('login'))->with('sucesso', 'Nova senha casdastrada com sucesso.');

            }else{
                return redirect()->to(site_url("password/reset/$token"))->with('errors_model', $this->usuarioModel->errors())->with('atencao', 'Por favor verifique os erros abaixo.')->withInput();
            }

        }else{

            return redirect()->to(site_url('password/esqueci'))->with('atencao', 'Link inválido ou expirado');
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
