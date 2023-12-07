<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<h1>Pedido <?= esc($pedido->codigo)?> realizado com sucesso</h1>

<p>Olá <strong><?= esc($pedido->usuario->nome)?></strong> recebemos o seu pedido de Código <strong><?= esc($pedido->codigo)?></strong></p>
<p>Estamos preparando tudo, em breve ele sairá para entrega.</p>
<p>Não se preocupe, quando isso acontecer avisaremos por email, beleza?</p>
<p>
  Enquanto isso <a href="<?= site_url('conta') ?>">Clique Aqui para ver os seus pedidos</a>

</p>