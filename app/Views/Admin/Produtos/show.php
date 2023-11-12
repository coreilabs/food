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
      <?php if($produto->imagem && $produto->deletado_em == null ):?>
      <img class="card-img-top" src="<?= site_url("admin/produtos/imagem/$produto->imagem")?>" alt="<?= esc($produto->nome)?>">
      <?php else: ?>
      <img class="card-img-top w-50" src="<?= site_url('admin/images/sem-imagem.webp')?>" alt="Produto sem imagem por enquanto">

      <?php endif;?>
    </div>

<?php if($produto->deletado_em == null) : ?>

  <a href="<?= site_url("admin/produtos/editarimagem/$produto->id")?>" class="btn btn-outline-success btn-sm mt-3 mb-3"><i class="mdi mdi-image btn-icon-prepend"></i> Editar Imagem</a>
<hr>

  <?php endif; ?>

      <p class="card-text"> <span class="font-weight-bold">Nome: </span> <?= esc($produto->nome)?></p>
      <p class="card-text"> <span class="font-weight-bold">Categoria: </span> <?= esc($produto->categoria)?></p>
      <p class="card-text"> <span class="font-weight-bold">Slug do Produto: </span> <?= esc($produto->slug)?></p>

      <p class="card-text"> <span class="font-weight-bold">Ativo: </span> <?= ($produto->ativo ? "Sim" : "Não" )?></p>

      <p class="card-text"> <span class="font-weight-bold">Criado: </span> <?= $produto->criado_em->humanize() ?></p>

      <?php if($produto->deletado_em == null ):?>

      <p class="card-text"> <span class="font-weight-bold">Atualizado: </span> <?= $produto->atualizado_em->humanize() ?></p>

      <?php else: ?>
        <p class="card-text"> <span class="font-weight-bold text-danger">Excluído: </span> <?= $produto->deletado_em->humanize() ?></p>

      <?php endif; ?>



<div class="mt-4">


<?php if($produto->deletado_em == null ):?>

  <a href="<?= site_url("admin/produtos/")?>" class="btn btn-primary btn-sm  btn-icon-text  m-1">
  <i class="btn-icon-prepend mdi mdi-keyboard-backspace"></i> Voltar</a>

  <a href="<?= site_url("admin/produtos/excluir/$produto->id")?>" class="btn btn-sm btn-danger btn-icon-text  m-1">
  <i class="mdi mdi-delete-forever btn-icon-prepend"></i>
  Excluir</a>

  <a href="<?= site_url("admin/produtos/editar/$produto->id")?>" class="btn btn-dark btn-sm btn-icon-text  m-1">
  <i class="btn-icon-prepend mdi mdi-pencil"></i> Editar</a>

  <a href="<?= site_url("admin/produtos/extras/$produto->id")?>" class="btn btn-success btn-sm btn-icon-text  m-1">
  <i class="btn-icon-prepend mdi mdi-pencil"></i> Extras</a>

  <a href="<?= site_url("admin/produtos/especificacoes/$produto->id")?>" class="btn btn-outline-warning btn-sm btn-icon-text  m-1">
  <i class="btn-icon-prepend mdi mdi-pencil"></i> Especificações</a>



<?php else: ?>

  

  <a href="<?= site_url("admin/produtos/")?>" class="btn btn-primary btn-sm  btn-icon-text  m-1">
  <i class="btn-icon-prepend mdi mdi-keyboard-backspace"></i> Voltar</a>

  <a href="<?= site_url("admin/produtos/desfazerexclusao/$produto->id")?>" class="btn btn-dark ml-2 btn-sm  " data-toggle="tooltip" data-placement="top" title="Desfazer exclusão">
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
