<?= $this->extend('layout/principal_web'); ?>


<?= $this->section('titulo'); ?>
<?= $titulo ?>
<?= $this->endSection(); ?>



<?= $this->section('estilos'); ?>

<link rel="stylesheet" href="<?= site_url("web/src/assets/css/produto.css")?>">

<?= $this->endSection(); ?>



<?= $this->section('conteudo'); ?>

<div class="container section" id="menu" data-aos="fade-up" style="margin-top: 3em">
      <div class="col-sm-12 col-md-12 col-lg-12">
          <!-- product -->
          <div class="product-content product-wrap clearfix product-deatil">
                <div class="row">    
                
              
                <h2 class="name">

                    <?php echo esc($titulo); ?>

                </h2>

                  <?php echo form_open("carrinho/especial"); ?>
                 

                  <div class="row">

                    <div class="col-md-12 " style="margin-bottom:2em;">


                        <?php if(session()->has('errors_model')): ?>

                        <ul style="margin-left: -1.6em !important; list-style:decimal">
                            <?php foreach(session('errors_model') as $error) : ?>

                            <li class="text-danger"><?php echo $error ?></li>

                            <?php endforeach; ?>
                        </ul>


                        <?php endif; ?>






                    </div>

                    <div class="col-md-6" >
                    
                    <label for="">Escolha seu produto</label>
                    <select name="primeira_metade" id="primeira_metade" class="form-control">
                        <option value="">Escolha seu produto</option>
                        <?php foreach($opcoes as $opcao):?>

                        <option value="<?= $opcao->id?>"><?= esc($opcao->nome)?></option>


                        <?php endforeach;?>
                    </select>

                    </div>

                    <div class="col-md-6" >
                    
                    <label for="">Segunda Metade</label>
                    <select name="segunda_metade" id="segunda_metade" class="form-control">
                       
                    <!-- aqui serao renderizadas as opcoes para compor a segunda metade, via javascript -->
                        
                    </select>

                    </div>
                        

                      </div>

                      <div class="row">
                      <div class="col-sm-4">

<input id="btn-adiciona" type="submit" class="btn btn-success btn-block "
    value="Adicionar ao carrinho">

</div>


<!-- Colocando o botão customizavel para aparecer somento se o item for customizavel -->
<?php foreach($especificacoes as $especificacao): ?>

<?php if($especificacao->customizavel): ?>

<div class="col-sm-4">

<a href="<?php echo site_url("produto/customizar/$produto->slug"); ?>"
    class="btn btn-primary btn-block ">Customizar</a>
</div>

<?php break; ?>
<?php endif; ?>
<?php endforeach; ?>

<div class="col-sm-4">

<a href="<?php echo site_url("/"); ?>" class="btn btn-info btn-block ">Mais produtos</a>
</div>
                      </div>

                  <?php echo form_close(); ?>
              </div>
          </div>
      </div>
      <!-- end product -->
  </div>

<?= $this->endSection(); ?>



<?= $this->section('scripts'); ?>

<script>
    $(document).ready(function(){


        var especificacao_id;

        if(!especificacao_id){
            $('#btn-adiciona').prop("disabled", true);
            $('#btn-adiciona').prop("value", "Selecione um valor");

        }

        $(".especificacao").on('click', function(){
            especificacao_id = $(this).attr('data-especificacao');
            $("#especificacao_id").val(especificacao_id);

            $('#btn-adiciona').prop("disabled", false);
            $('#btn-adiciona').prop("value", "Adicionar");

        });

        $(".extra").on('click', function(){
            var extra_id = $(this).attr('data-extra');
            $("#extra_id").val(extra_id);

       

        });
      
    });
</script>
<?= $this->endSection(); ?>

     
     
     
   