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

        

                <?php if(!empty($bairros)):?>

                <h3 class="text-center section-title">Não há dados para exibir</h3>

                <?php else:?>

                    <div class="col-xs-12 col-md-12 col-lg-12">
                <h2 class="section-title"><?= esc($titulo)?></h2>    

                </div>

                    <?php foreach($bairros as $bairro):?>

<div class="col-md-4">
    <div class="panel panel-default">
    <div class="panel-heading panel-food" style="background: #990100 !important;"><?= esc($bairro->nome)?> - <?= esc($bairro->cidade)?></div>

    <div class="panel-body fonte-food" >Taxa de Entrega: R$ <?= esc(number_format($bairro->valor_entrega, 2, ',', '.'))?></div>
    </div>
</div>

<?php endforeach;?>



                <?php endif;?>




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

     
     
     
   