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

            dd($autenticacao);


        }else{
            return redirect()->back();
        }
    }
}
