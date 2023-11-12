<?= $this->extend('Admin/layout/principal'); ?>


<?= $this->section('titulo'); ?>
<?= $titulo ?>
<?= $this->endSection(); ?>



<?= $this->section('estilos'); ?>






<?= $this->endSection(); ?>



<?= $this->section('conteudo'); ?>

<div class="row justify-content-md-center">
           
<div class="col-lg-6 grid-margin stretch-card">
  <div class="card">
  <div class="card-header bg-primary pn-0 pt-4">
  <h2 class="card-title text-white"><?= esc($titulo) ?></h2>

</div>
    <div class="card-body">

    <div class="text-center">
      <?php if($entregador->imagem && $entregador->deletado_em == null ):?>
      <img class="card-img-top" src="<?= site_url("admin/entregadores/imagem/$entregador->imagem")?>" alt="<?= esc($entregador->nome)?>">
      <?php else: ?>
      <img class="card-img-top w-50" src="<?= site_url('admin/images/sem-imagem.webp')?>" alt="Entregador sem imagem por enquanto">

      <?php endif;?>
    </div>

<?php if($entregador->deletado_em == null) : ?>

  <a href="<?= site_url("admin/entregadores/editarimagem/$entregador->id")?>" class="btn btn-outline-success btn-sm mt-3 mb-3"><i class="mdi mdi-image btn-icon-prepend"></i> Editar Imagem</a>
<hr>

  <?php endif; ?>

      <p class="card-text"> <span class="font-weight-bold">Nome: </span> <?= esc($entregador->nome)?></p>
      <p class="card-text"> <span class="font-weight-bold">Telefone: </span> <?= esc($entregador->telefone)?></p>
      <p class="card-text"> <span class="font-weight-bold">Veiculo: </span> <?= esc($entregador->veiculo)?> | <?= esc($entregador->placa)?> </p>

      <p class="card-text"> <span class="font-weight-bold">Ativo: </span> <?= ($entregador->ativo ? "Sim" : "Não" )?></p>

      <p class="card-text"> <span class="font-weight-bold">Criado: </span> <?= $entregador->criado_em->humanize() ?></p>

      <?php if($entregador->deletado_em == null ):?>

      <p class="card-text"> <span class="font-weight-bold">Atualizado: </span> <?= $entregador->atualizado_em->humanize() ?></p>

      <?php else: ?>
        <p class="card-text"> <span class="font-weight-bold text-danger">Excluído: </span> <?= $entregador->deletado_em->humanize() ?></p>

      <?php endif; ?>



<div class="mt-4">


<?php if($entregador->deletado_em == null ):?>

  <a href="<?= site_url("admin/entregadores/")?>" class="btn btn-primary btn-sm  btn-icon-text  m-1">
  <i class="btn-icon-prepend mdi mdi-keyboard-backspace"></i> Voltar</a>

  <a href="<?= site_url("admin/entregadores/excluir/$entregador->id")?>" class="btn btn-sm btn-danger btn-icon-text  m-1">
  <i class="mdi mdi-delete-forever btn-icon-prepend"></i>
  Excluir</a>

  <a href="<?= site_url("admin/entregadores/editar/$entregador->id")?>" class="btn btn-dark btn-sm btn-icon-text  m-1">
  <i class="btn-icon-prepend mdi mdi-pencil"></i> Editar</a>




<?php else: ?>

  

  <a href="<?= site_url("admin/entregadores/")?>" class="btn btn-primary btn-sm  btn-icon-text  m-1">
  <i class="btn-icon-prepend mdi mdi-keyboard-backspace"></i> Voltar</a>

  <a href="<?= site_url("admin/entregadores/desfazerexclusao/$entregador->id")?>" class="btn btn-dark ml-2 btn-sm  " data-toggle="tooltip" data-placement="top" title="Desfazer exclusão">
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
