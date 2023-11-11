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
                <option value="">Escolha...</option>

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



<div class="col-md-12">
<hr>
<?php if(empty($produtosExtras)) :{            } ?>
<p> Esse produto não possui extras até o momento.</p>
<?php else: ?>

  <h4 class="card-title">Extras do Produto</h4>
                  <p class="card-description">
                  <code>Aproveite para gerenciar os extras</code>
                  </p>
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>Extra</th>
                          <th>Preço</th>
                          <th class="text-center">Remover</th>
                     
                        </tr>
                      </thead>
                      <tbody>

                      <?php foreach($produtosExtras as $extraProduto):?>
                        <tr>
                          <td><?= esc($extraProduto->extra)?></td>
                          <td>R$ <?= esc(number_format($extraProduto->preco, 2));?></td>
                          <td class="text-center">
                            <?= form_open("excluirextra/$extraProduto->id")?>
                        
                          <button type="submit" class="btn badge badge-danger"> X </button>
                          <?= form_close();?>
                        
                        </td>
                        </tr>
                       
                      <?php endforeach;?>

                      </tbody>
                    </table>
                    <div class="mt-3">
                      <?= $pager->links()?>
                    </div>
                  </div>
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
