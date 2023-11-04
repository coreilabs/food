<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('welcome_message');
    }
    public function email(){
    

        $email = \Config\Services::email();

        $email->setFrom('eldedodeouro@gmail.com', 'Your Name');
        $email->setTo('eldedodeouro@gmail.com');
        // $email->setCC('another@another-example.com');
        // $email->setBCC('them@their-example.com');
        
        $email->setSubject('Outro Email');
        $email->setMessage('Email funcionando.');
        
        if($email->send()){
            echo 'email enviado';
        }else{
          echo $email->printDebugger();  
        }

    }
}
