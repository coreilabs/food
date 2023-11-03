<?php

/**
 * @descricao essa biblioteca / classe cuidará da parte de autenticacao da nossa aplicacao
 * 
 */

 class Autenticacao{
    private $usuario;

    /**
     * @param string $email
     * @param string password
     * @return boolean
     */

    public function login(string $email, string $password){

        $usuarioModel = new App\Models\UsuarioModel();

        $usuario = $usuarioModel->buscaUsuarioPorEmail($email);

        //nao encontrar usuario por email retorna false
        if($usuario === null){

            return false;

        }
        //se a senha nao combinar com o password_hash retorna false
        if(!$usuario->verificaPassword($password)){
            return false;

        }

        /**
         * so permitiremos o login de usuarios ativos
         */
        if(!$usuario->ativo){

            return false;

        }

        // nesse ponto esta tudo certo e podemos logar o usuário invocando o método abaixo
        $this->logaUsuario($usuario);
        
        // retornamos true, tudo certo
        return true;




    }


    public function logout(){

        session()->destroy();
    }

    public function pegaUsuarioLogado(){

        // Não esquecer de compartilhar a instância com services

        if($this->usuario === null){

            $this->usuario = $this->pegaUsuarioDaSessao();

        }

        //retornamos o usuario que foi definido no inicio da classe
        return $this->usuario;
    }


    /**
     * @descricao: O metodo so permite ficar logado na aplicaçao aquele que ainda existir na base e que esteja ativo. Do contrario, sera feito o logout do mesmo,
     * caso haja uma mudanca a sua conta durante a sessao
     * 
     * @uso no filtro LoginFilter
     * 
     * @return retorna true se o metodo pegaUsuarioLogado() nao for null. Ou seja se o usuario estiver logado.
     */


    public function estaLogado(){
        return $this->pegaUsuarioLogado() !== null;
    }

    private function pegaUsuarioDaSessao(){


        if(!session()->has('usuario_id')){
            return null;
        }
        
        //instanciamos o model usuario
        $usuarioModel = new App\Models\UsuarioModel();
        
        // recupero o usuario de acordo com a chave da sessao 'usuario_id'
        $usuario = $usuarioModel->find(session()->get('usuario_id'));


        // so retorno o objeto usuario se o mesmo for encontrado e estiver ativo
        if($usuario && $usuario->ativo){

            return $usuario;


        }
    }


    private function logaUsuario(object $usuario){

        $session = session();
        $session->regenerate();
        $session->set('usuario_id', $usuario->id);

    }
 }