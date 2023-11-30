<h1><?= esc($usuario->nome)?> Falta pouco para ativar sua conta</h1>

<p>Clique no link abaixo para ativar sua conta <?= esc($usuario->nome)?></p>

<p>
  <a href="<?= site_url('registrar/ativar/'.$usuario->token) ?>">Ativar Minha Conta - Clique Aqui</a>

</p>