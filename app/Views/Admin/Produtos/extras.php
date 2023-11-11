<?= $this->extend('Admin/layout/principal'); ?>


<?= $this->section('titulo'); ?>
<?= $titulo ?>
<?= $this->endSection(); ?>



<?= $this->section('estilos'); ?>

<link rel="stylesheet" href="<?= site_url('admin/vendors/select2/select2.min.css'); ?>">




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

        
                   
        <?= form_open("admin/produtos/cadastrarextras/$produto->id")?>


        <div class="form-row">
            <div class="form-group col-md-12">
              <label for="">Escolha o Extra do produto (opcional)</label>

              <select name="extra_id" class="form-control js-example-basic-single" id="">
                <option>Escolha...</option>

                <?php foreach ($extras as $extra) :?>
            <option value="<?= $extra->id ?>"> <?= $extra->nome ?></option>
                <?php endforeach; ?>


              </select>
            </div>


        </div>


        
<button type="submit"  class="btn btn-dark btn-icon-text btn-sm  m-1">
    <i class="mdi mdi-content-save btn-icon-prepend"></i>
    Inserir Extra
</button>
          
            <a href="<?= site_url("admin/produtos/show/$produto->id")?>" class="btn btn-primary btn-sm  btn-icon-text  m-1">
  <i class="btn-icon-prepend mdi mdi-keyboard-backspace"></i> Voltar</a>




<div class="form-row mt-5">
<hr>


<div class="col-md-12">

<?php if(empty($produtosExtras)) :{            } ?>
<p> Esse produto não possui extras até o momento.</p>
<?php else: ?>


 <?php endif; ?>
</div>

</div>


          <?= form_close();?>


    </div>
  </div>
            

          </div>


<?= $this->endSection(); ?>



<?= $this->section('scripts'); ?>


<script src="<?= site_url('admin/vendors/select2/select2.min.js')?>"></script>


<script>

  // In your Javascript (external .js resource or <script> tag)
$(document).ready(function() {
    $('.js-example-basic-single').select2({
      placeholder: 'Digite o nome do extra...',
      allowClear: false,

      "language":{
        "noResults": function(){
          return "Extra não encontrado. <a class='btn btn-primary btn-sm' href='<?= site_url('admin/extras/criar')?>'>Cadastrar </a>";
        }

      },
      escapeMarkup: function (markup){
        return markup;
      }
    });
});


</script>
<?= $this->endSection(); ?>
