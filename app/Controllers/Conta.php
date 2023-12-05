<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Conta extends BaseController
{

    private $usuario;

    public function __construct(){
        $this->usuario = service("autenticacao")->pegaUsuarioLogado();
    }

    public function index()
    {
        dd($this->usuario);
    }
    public function show(){
        $data = [
            'titulo' => 'Meus dados',
            'usuario' => $this->usuario
        ];
        return view('Conta/show', $data);
    }

    public function editar(){

        if(!session()->has('pode_editar_ate')){

            return redirect()->to(site_url('conta/autenticar'));

        }

        if(session()->get('pode_editar_ate') < time()){

            return redirect()->to(site_url('conta/autenticar'));

        }



        $data = [
            'titulo' => 'Editar meus dados',
            'usuario' => $this->usuario
        ];
        return view('Conta/editar', $data);
    }

    public function autenticar(){
        $data = [
            'titulo' => 'Insira novamente sua senha',
            'usuario' => $this->usuario
        ];
        return view('Conta/autenticar', $data);
    }

    public function processaAutenticacao(){

        if($this->request->getMethod() === 'post'){

            if($this->usuario->verificaPassword($this->request->getPost('password'))){

                session()->set('pode_editar_ate', time() + 300); // 5 minutos

                return redirect()->to(site_url('conta/editar'));

            }else{

                return redirect()->back()->with('atencao', 'Senha Inválida');

            }


        }else{
            return redirect()->back();
        }

    }

}

