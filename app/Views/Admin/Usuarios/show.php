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



      <p class="card-text"> <span class="font-weight-bold">Nome: </span> <?= esc($usuario->nome)?></p>
      <p class="card-text"> <span class="font-weight-bold">Email: </span> <?= esc($usuario->email)?></p>
      <p class="card-text"> <span class="font-weight-bold">Ativo: </span> <?= ($usuario->ativo ? "Sim" : "Não" )?></p>
      <p class="card-text"> <span class="font-weight-bold">Perfil: </span> <?= ($usuario->is_admin ? "Administrador" : "Cliente" )?></p>
      <p class="card-text"> <span class="font-weight-bold">Criado: </span> <?= $usuario->criado_em->humanize() ?></p>

      <?php if($usuario->deletado_em == null ):?>

      <p class="card-text"> <span class="font-weight-bold">Atualizado: </span> <?= $usuario->atualizado_em->humanize() ?></p>

      <?php else: ?>
        <p class="card-text"> <span class="font-weight-bold text-danger">Excluído: </span> <?= $usuario->deletado_em->humanize() ?></p>

      <?php endif; ?>



<div class="mt-4">


<?php if($usuario->deletado_em == null ):?>

  <a href="<?= site_url("admin/usuarios/")?>" class="btn btn-primary btn-sm  btn-icon-text  m-1">
  <i class="btn-icon-prepend mdi mdi-keyboard-backspace"></i> Voltar</a>

  <a href="<?= site_url("admin/usuarios/excluir/$usuario->id")?>" class="btn btn-sm btn-danger btn-icon-text  m-1">
  <i class="mdi mdi-delete-forever btn-icon-prepend"></i>
  Excluir</a>

  <a href="<?= site_url("admin/usuarios/editar/$usuario->id")?>" class="btn btn-dark btn-sm btn-icon-text  m-1">
  <i class="btn-icon-prepend mdi mdi-pencil"></i> Editar</a>



<?php else: ?>

  

  <a href="<?= site_url("admin/usuarios/")?>" class="btn btn-primary btn-sm  btn-icon-text  m-1">
  <i class="btn-icon-prepend mdi mdi-keyboard-backspace"></i> Voltar</a>

  <a href="<?= site_url("admin/usuarios/desfazerexclusao/$usuario->id")?>" class="btn btn-dark ml-2 btn-sm  " data-toggle="tooltip" data-placement="top" title="Desfazer exclusão">
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
