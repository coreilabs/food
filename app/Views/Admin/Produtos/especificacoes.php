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

        
                   
        <?= form_open("admin/produtos/cadastrarespecificacoes/$produto->id")?>


        <div class="form-row">
            <div class="form-group col-md-12">
              <label for="">Escolha a medida do produto <a href="javascript:void" class="" data-toggle="popover" title="Medida do Produto" data-content="Exemplo: <br>Pizza Grande<br> Pizza Média<br> Pizza Família..."> Entenda</a></label>

              <select name="medida_id" class="form-control js-example-basic-single" id="">
                <option value="">Escolha...</option>

                <?php foreach ($medidas as $medida) :?>
            <option value="<?= $medida->id ?>"> <?= $medida->nome ?></option>
                <?php endforeach; ?>


              </select>
            </div>

            <div class="form-group col-md-12 ">
        <label for="preco">Preço</label>
        <input type="text" class="money form-control" name="preco" id="preco" placeholder="Preço" value="<?= old('preco') ?>">
    </div>


    <div class="form-group col-md-12">
              <label for="">Produto Customizável <a href="javascript:void" class="" data-toggle="popover" title="Produto Meio a Meio" data-content="Exemplo: Metade Calabresa e Metade Bacon"> Entenda</a>
              <select name="customizavel" class="form-control" id="">
                <option value="">Escolha...</option>

                  <option value="1">Sim</option>
                  <option value="0">Não</option>



              </select>
            </div>

        </div>


        
<button type="submit"  class="btn btn-dark btn-icon-text btn-sm  m-1">
    <i class="mdi mdi-content-save btn-icon-prepend"></i>
    Inserir Especificação
</button>
          
            <a href="<?= site_url("admin/produtos/show/$produto->id")?>" class="btn btn-primary btn-sm  btn-icon-text  m-1">
  <i class="btn-icon-prepend mdi mdi-keyboard-backspace"></i> Voltar</a>


  <?= form_close();?>

<div class="form-row mt-5">



<div class="col-md-12">
<hr>
<?php if(empty($produtoEspecificacoes)) : ?>


  <div class="alert alert-warning" role="alert">
  <h4 class="alert-heading">Atenção</h4>
  <p> Esse produto não possui especificações até o momento. Ele <strong>não será exibido </strong>para compra na área pública </p>
  <hr>
  <p class="mb-0">Aproveite para cadastrar pelo menos uma especificação para o produto <strong><?= esc($produto->nome)?></strong>.</p>
</div>



<?php else: ?>

  <h4 class="card-title">Especificações do Produto</h4>
                  <p class="card-description">
                  <code>Aproveite para gerenciar as especificações</code>
                  </p>
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>Medida</th>
                          <th>Preço</th>
                          <th>Customizável</th>

                          <th class="text-center">Remover</th>
                     
                        </tr>
                      </thead>
                      <tbody>

                      <?php foreach($produtoEspecificacoes as $especificacao):?>
                        <tr>
                          <td><?= esc($especificacao->medida)?></td>
                          <td>R$ <?= esc(number_format($especificacao->preco, 2));?></td>
                          <td > <?php echo ($especificacao->customizavel ? '<label class="badge badge-primary">Sim</label>' : '<label class="badge badge-warning">Não</label>' )?></td>
                          <td class="text-center">

                          <button type="submit" class="btn badge badge-danger"> X </button>
                        
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


      



    </div>
  </div>
            

          </div>


<?= $this->endSection(); ?>



<?= $this->section('scripts'); ?>


<script src="<?= site_url('admin/vendors/select2/select2.min.js')?>"></script>
<script src="<?= site_url('admin/vendors/mask/jquery.mask.min.js')?>"></script>
<script src="<?= site_url('admin/vendors/mask/app.js')?>"></script>


<script>


$(function () {
  $('[data-toggle="popover"]').popover({
    placement: 'top',
    html: true,
  })
})

  // In your Javascript (external .js resource or <script> tag)
$(document).ready(function() {
    $('.js-example-basic-single').select2({
      placeholder: 'Digite o nome da medida...',
      allowClear: false,

      "language":{
        "noResults": function(){
          return "Medida não encontrada. <a class='btn btn-primary btn-sm' href='<?= site_url('admin/medidas/criar')?>'>Cadastrar </a>";
        }

      },
      escapeMarkup: function (markup){
        return markup;
      }
    });
});


</script>
<?= $this->endSection(); ?>
