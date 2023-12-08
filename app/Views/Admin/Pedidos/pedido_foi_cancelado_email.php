<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">


<h3>Que pena, o Pedido <?= esc($pedido->codigo)?> foi cancelado!</h3>

<p>Lamentamos que isso tenha ocorrido</p>
<p>Sinta-se à vontade para falar conosco</p>


<p>
  <a href="<?= site_url('conta') ?>">Ver Meus Pedidos</a>

</p>