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



      <?php if(session()->has('errors_model')) : ?>

        <ul>
          <?php foreach (session('errors_model') as $error):?>

              <li class="text-danger"><?= $error ;?></li>

            <?php endforeach; ?>
        </ul>

      <?php endif;?>

        
                   
        <?= form_open("admin/extras/excluir/$extra->id")?>

        <div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Atenção: </strong> Tem certeza da exclusão do extra <?= esc($extra->nome) ?>?

</div>








            <div class="m-4">

<button type="submit"  class="btn btn-sm btn-danger btn-icon-text  m-1">
  <i class="mdi mdi-delete-forever btn-icon-prepend"></i>
  Excluir
</button>



  <a href="<?= site_url("admin/extras/show/$extra->id")?>" class="btn btn-primary btn-sm  btn-icon-text  m-1">
  <i class="btn-icon-prepend mdi mdi-keyboard-backspace"></i> Voltar</a>

 

</div>



          <?= form_close();?>


    </div>
  </div>"
            

          </div>
          </div>


<?= $this->endSection(); ?>



<?= $this->section('scripts'); ?>
<script src="<?= site_url('admin/vendors/mask/jquery.mask.min.js')?>"></script>
<script src="<?= site_url('admin/vendors/mask/app.js')?>"></script>

<?= $this->endSection(); ?>
