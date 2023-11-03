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

    private function logaUsuario(object $usuario){

        $session = session();
        $session->regenerate();
        $session->set('usuario_id', $usuario->id);

    }
 }