<?= $this->extend('Admin/layout/principal'); ?>


<?= $this->section('titulo'); ?>
<?= $titulo ?>
<?= $this->endSection(); ?>



<?= $this->section('estilos'); ?>






<?= $this->endSection(); ?>



<?= $this->section('conteudo'); ?>

<div class="row justify-content-md-center">
           
  <div class="col-lg-6  grid-margin stretch-card">
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

        
                   
        <?= form_open("admin/pedidos/atualizar/$pedido->codigo")?>



        <div class="form-check form-check-flat form-check-primary">
            <label for="saiu_entrega" class="form-check-label">

              <input id="saiu_entrega" type="radio" class="form-check-input" name="situacao" value="1" <?php echo ($pedido->situacao == 1 ? 'checked' : '');?> >

              Saiu para Entrega
            </label>

        </div>

        <div class="form-check form-check-flat form-check-primary">
            <label  class="form-check-label">

              <input type="radio" class="form-check-input" name="situacao" value="2" <?php echo ($pedido->situacao == 2 ? 'checked' : '');?> >

             Pedido Entregue
            </label>

        </div>
        <div class="form-check form-check-flat form-check-primary">
            <label  class="form-check-label">

              <input type="radio" class="form-check-input" name="situacao" value="2" <?php echo ($pedido->situacao == 3 ? 'checked' : '');?> >

             Pedido Cancelado
            </label>

        </div>

          
            <a href="<?= site_url("admin/pedidos/show/$pedido->codigo")?>" class="btn btn-primary btn-sm  btn-icon-text  m-1">
  <i class="btn-icon-prepend mdi mdi-keyboard-backspace"></i> Voltar</a>







          <?= form_close();?>


    </div>
  </div>
            

          </div>


<?= $this->endSection(); ?>



<?= $this->section('scripts'); ?>
<script src="<?= site_url('admin/vendors/mask/jquery.mask.min.js')?>"></script>
<script src="<?= site_url('admin/vendors/mask/app.js')?>"></script>

<?= $this->endSection(); ?>
