<?php

namespace App\Controllers;

use App\Controllers\BaseController;


class Login extends BaseController
{
    public function novo()
    {
        $data = [
            'titulo' => 'Realize o login',
        ];
        return view('Login/Novo', $data);
    }

    public function criar(){
        if($this->request->getMethod() === 'post'){

          
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            

            $autenticacao = service('autenticacao');
            
            if($autenticacao->login($email, $password)){
                $usuario = $autenticacao->pegaUsuarioLogado();

                return redirect()->to(site_url('admin/home'))->with('sucesso', "Olá $usuario->nome que bom que está de volta.");
            }else{
                return redirect()->back()->with('atencao', "Não encontramos suas credenciais de acesso.");
            }




        }else{
            return redirect()->back();
        }
    }
    
    /**
     * Para que possamos exibir a mensagem de "sua sessao expiurou ou que voce acha melhor" 
     * apos o logou, devemos fazere uma requisicao para um url, nesse caso a 'showLogoutMessage
     * pois quando fazemos o logou todos os dados da sessao atual incluindo os flashdata sao destruidos
     * ou seja as mensagens nao sao exibidas
     * 
     * portanto para conseguirmos exibi-las basta criarmos o metodo "mostraMensagemLogout que fara o redirect para a home
     * e como se trata de um redirect a mensagem so sera exibida uma vez
     */
    public function logout(){
        //vamos alterar esse método
        service('autenticacao')->logout();
        return redirect()->to(site_url('login/mostraMensagemLogout'));
    }

    public function mostraMensagemLogout(){

        return redirect()->to(site_url('login/novo'))->with('info', "Esperamos ver você novamente.");
        
    }
}
