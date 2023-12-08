<?= $this->extend('Admin/layout/principal'); ?>


<?= $this->section('titulo'); ?>
<?= $titulo ?>
<?= $this->endSection(); ?>



<?= $this->section('estilos'); ?>






<?= $this->endSection(); ?>



<?= $this->section('conteudo'); ?>

<div class="row justify-content-md-center">
           
<div class="col-lg-5 grid-margin stretch-card">
  <div class="card">
  <div class="card-header bg-primary pn-0 pt-4">
  <h2 class="card-title text-white"><?= esc($titulo) ?></h2>

</div>
    <div class="card-body">



      <p class="card-text"> <span class="font-weight-bold">Situação: </span> <?= esc($pedido->exibeSituacaoDoPedido())?></p>
      <p class="card-text"> <span class="font-weight-bold">Criado: </span> <?= $pedido->criado_em->humanize() ?></p>
      <p class="card-text"> <span class="font-weight-bold">Atualizado: </span> <?= $pedido->atualizado_em->humanize() ?></p>
      <p class="card-text"> <span class="font-weight-bold">Forma de Pagamento: </span> <?= $pedido->forma_pagamento ?></p>
      <p class="card-text"> <span class="font-weight-bold">Valor de entrega: R$ </span> <?= esc(number_format($pedido->valor_entrega,2,',', '.'))?></p>
  


      <?php if($pedido->deletado_em == null ):?>


      <?php else: ?>
        <p class="card-text"> <span class="font-weight-bold text-danger">Excluído: </span> <?= $pedido->deletado_em->humanize() ?></p>

      <?php endif; ?>

      <?php $produtos = unserialize($pedido->produtos); ?>

      <ul class="list-group">

      <?php foreach($produtos as $produto):?>
       
        <li class="list-group-item">
          <p><strong>Produto:</strong> <?= $produto['nome']?></p>
          <p><strong>Quantidade:</strong> <?= $produto['quantidade']?></p>
          <p><strong>Preço: R$ </strong> <?= number_format($produto['preco'], 2 , ',', '.')?></p>
        </li>
      <?php endforeach;?>

      </ul>

      <div class="mt-4">


<a href="<?= site_url("admin/pedidos/")?>" class="btn btn-primary btn-sm  btn-icon-text  m-1">
<i class="btn-icon-prepend mdi mdi-keyboard-backspace"></i> Voltar</a>

<a href="<?= site_url("admin/pedidos/excluir/$pedido->codigo")?>" class="btn btn-sm btn-danger btn-icon-text  m-1">
<i class="mdi mdi-delete-forever btn-icon-prepend"></i>
Excluir Pedido</a>

<a href="<?= site_url("admin/pedidos/editar/$pedido->codigo")?>" class="btn btn-dark btn-sm btn-icon-text  m-1">
<i class="btn-icon-prepend mdi mdi-pencil"></i> Alterar Situação</a>









</div>




</div>

  </div>
</div>
</div>"
          



<?= $this->endSection(); ?>



<?= $this->section('scripts'); ?>

<?= $this->endSection(); ?>
