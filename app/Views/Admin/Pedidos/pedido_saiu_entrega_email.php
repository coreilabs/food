<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">


<h3>O Pedido <?= esc($pedido->codigo)?>  saiu para entrega!</h3>

<p>Olá <?= esc($pedido->nome)?>, seu Pedido <?= esc($pedido->codigo)?> saiu para entrega! </p>
<p>A forma de pagamento escolhida foi <strong><?= esc($pedido->forma_pagamento)?> </strong></p>
<p>O endereço para entrega é <strong><?= esc($pedido->endereco_entrega)?> </strong></p>
<p>Observações do Pedido <strong><?= esc($pedido->observacoes)?> </strong></p>
<hr>
<p>O entregador é <strong><?= esc($pedido->entregador->nome)?> </strong>, Veículo <strong><?= esc($pedido->entregador->veiculo)?>, Placa <strong><?= esc($pedido->entregador->placa)?> </p>

<p>
  <a href="<?= site_url('conta') ?>">Ver Meus Pedidos</a>

</p>