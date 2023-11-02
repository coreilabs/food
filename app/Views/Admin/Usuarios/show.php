<?= $this->extend('Admin/layout/principal'); ?>


<?= $this->section('titulo'); ?>
<?= $titulo ?>
<?= $this->endSection(); ?>



<?= $this->section('estilos'); ?>






<?= $this->endSection(); ?>



<?= $this->section('conteudo'); ?>

<div class="row justify-content-md-center">
           
<div class="col-lg-4 grid-margin stretch-card">
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
      <p class="card-text"> <span class="font-weight-bold">Atualizado: </span> <?= $usuario->atualizado_em->humanize() ?></p>

<div class="mt-4">
  <a href="<?= site_url("admin/usuarios/")?>" class="btn btn-primary btn-sm btn-icon-text btn-icon-prepend mdi mdi-keyboard-backspace m-1"> Voltar</a>
  <a href="<?= site_url("admin/usuarios/editar/$usuario->id")?>" class="btn btn-dark btn-sm btn-icon-text btn-icon-prepend mdi mdi-pencil m-1"> Editar</a>
  <a href="<?= site_url("admin/usuarios/editar/$usuario->id")?>" class="btn btn-danger btn-sm btn-icon-text btn-icon-prepend mdi mdi-delete-forever m-1"> Excluir</a>
</div>

    </div>
  </div>
</div>"
            

          </div>


<?= $this->endSection(); ?>



<?= $this->section('scripts'); ?>

<?= $this->endSection(); ?>
