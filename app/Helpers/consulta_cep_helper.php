<?php

if(!function_exists('consultaCep')){

    function consultaCep(string $cep){
        $urlViaCep = "https://viacep.com.br/ws/{$cep}/json/";
        //abre a conexão
        $ch = curl_init();

        //definindo a URL
        curl_setopt($ch, CURLOPT, $urlViaCep);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        //executamos o POST
        $json = curl_exec($ch);

        //decodificando o objeto json
        $resultado = json_decode($json);

        //fechar conexao
        return $resultado;
    }

}