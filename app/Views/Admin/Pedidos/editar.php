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

              <input id="saiu_entrega" type="radio" class="form-check-input situacao" name="situacao" value="1" <?php echo ($pedido->situacao == 1 ? 'checked' : '');?> >

              Saiu para Entrega
            </label>

        </div>

        <div id="box_entregador" class="form-group d-none">
          <select name="entregador_id"  class="form-control text-dark">
            <?php foreach($entregadores as $entregador):?>
              <option value="<?= $entregador->id?>" <?= ($entregador->id == $pedido->entregador_id ? 'selected' : '')?>><?= esc($entregador->nome)?></option>
              <?php endforeach;?>
            </select>
        </div>

        <div class="form-check form-check-flat form-check-primary">
            <label  class="form-check-label">

              <input type="radio" class="form-check-input situacao" name="situacao" value="2" <?php echo ($pedido->situacao == 2 ? 'checked' : '');?> >

             Pedido Entregue
            </label>

        </div>
        <div class="form-check form-check-flat form-check-primary">
            <label  class="form-check-label">

              <input type="radio" class="form-check-input situacao" name="situacao" value="3" <?php echo ($pedido->situacao == 3 ? 'checked' : '');?> >

             Pedido Cancelado
            </label>

        </div>

        
        <input type="submit" id="btn-editar-pedido" class="btn btn-success" value="Atualizar Pedido">

        <a href="<?= site_url("admin/pedidos/show/$pedido->codigo")?>" class="btn btn-primary btn-sm  btn-icon-text  m-1">
          <i class="btn-icon-prepend mdi mdi-keyboard-backspace"></i> Voltar
        </a>







          <?= form_close();?>


    </div>
  </div>
            

          </div>


<?= $this->endSection(); ?>



<?= $this->section('scripts'); ?>
<script src="<?= site_url('admin/vendors/mask/jquery.mask.min.js')?>"></script>
<script src="<?= site_url('admin/vendors/mask/app.js')?>"></script>

<script>
  $(document).ready(function(){
    var entregador_id = $("#saiu_entrega").prop('checked');
    if(entregador_id){

      $("#box_entregador").removeClass('d-none');

    }
    $('.situacao').on('click', function(){
      var valor = $(this).val();
      if(valor == '1'){

        $("#box_entregador").removeClass('d-none');

      }else{
        $("#box_entregador").addClass('d-none');
      }
    });

    $("form").submit(function() {
        $(this).find(":submit").attr('disabled', 'disabled');
        $("#btn-editar-pedido").val('Atualizando seu pedido');
    
    });

  });
</script>

<?= $this->endSection(); ?>
