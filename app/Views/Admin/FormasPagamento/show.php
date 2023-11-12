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

      <?php if ($forma->id == 1):?>
        <div class="alert alert-primary mb-3" role="alert">

        A forma de pagamento <strong><?= esc($forma->nome)?></strong> não pode ser <span class="text-danger">editada ou excluída</span>, pois essa opção terá vinculada ou não o 
        envio de troco para o cliente quando o mesmo estiver no <strong>Checkout</strong>.

      </div>
      <?php endif;?>

      <p class="card-text"> <span class="font-weight-bold ">Nome: </span> <?= esc($forma->nome)?></p>
      <p class="card-text"> <span class="font-weight-bold">Ativo: </span> <?= ($forma->ativo ? "Sim" : "Não" )?></p>

      <p class="card-text"> <span class="font-weight-bold">Criado: </span> <?= $forma->criado_em->humanize() ?></p>

      <?php if($forma->deletado_em == null ):?>

      <p class="card-text"> <span class="font-weight-bold">Atualizado: </span> <?= $forma->atualizado_em->humanize() ?></p>

      <?php else: ?>
        <p class="card-text"> <span class="font-weight-bold text-danger">Excluído: </span> <?= $forma->deletado_em->humanize() ?></p>

      <?php endif; ?>



<div class="mt-4">


<?php if($forma->deletado_em == null ):?>

  <a href="<?= site_url("admin/formas/")?>" class="btn btn-primary btn-sm  btn-icon-text  m-1">
  <i class="btn-icon-prepend mdi mdi-keyboard-backspace"></i> Voltar</a>



  <?php if ($forma->id != 1):?>

  <a href="<?= site_url("admin/formas/excluir/$forma->id")?>" class="btn btn-sm btn-danger btn-icon-text  m-1">
  <i class="mdi mdi-delete-forever btn-icon-prepend"></i>
  Excluir</a>

  <a href="<?= site_url("admin/formas/editar/$forma->id")?>" class="btn btn-dark btn-sm btn-icon-text  m-1">
  <i class="btn-icon-prepend mdi mdi-pencil"></i> Editar</a>

  <?php endif; ?>

<?php else: ?>

  

  <a href="<?= site_url("admin/formas/")?>" class="btn btn-primary btn-sm  btn-icon-text  m-1">
  <i class="btn-icon-prepend mdi mdi-keyboard-backspace"></i> Voltar</a>

  <a href="<?= site_url("admin/formas/desfazerexclusao/$forma->id")?>" class="btn btn-dark ml-2 btn-sm  " data-toggle="tooltip" data-placement="top" title="Desfazer exclusão">
  <i class="btn-icon-prepend mdi mdi-undo"></i> Desfazer</a>

<?php endif; ?>






</div>




</div>

    </div>
  </div>
</div>"
            



<?= $this->endSection(); ?>



<?= $this->section('scripts'); ?>

<?= $this->endSection(); ?>
