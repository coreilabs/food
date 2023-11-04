<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use App\Libraries\Token;

class Usuario extends Entity
{

    protected $dates   = [
    'criado_em',
    'atualizado_em',
    'deletado_em'
];

public function verificaPassword(string $password){
    return password_verify($password, $this->password_hash);
}
public function iniciaPasswordReset(){

    /**
     * instancio novo objeto da classe token
     */
    $token = new Token();

    /**
     * @descricao: atribuimos ao objeto Entitie Usuario ($this) o atributo 'reset_token' que contera o token gerado para que possamos
     * acessá-lo na view 'Passoword/reset_email'
     */
    $this->reset_token = $token->getValue();

    /**
     * @descricao atribuimos ao objeto entitie usuario ($this) o atributo 'reset_hash' que contera o hash do token
     */
    $this->reset_hash = $token->getHash();

    /**
     * @descricao atribuios ao objeto Entitie Usuario ($this) o atributo 'reset_expira_em' que conterá a data de expiracao do token gerado
     */
    $this->reset_expira_em = date('Y-m-d H:i:s', time() + 7200); // expira em duas horas a partir da data e hora atuais
}

}
