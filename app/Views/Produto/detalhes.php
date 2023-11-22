<?= $this->extend('layout/principal_web'); ?>


<?= $this->section('titulo'); ?>
<?= $titulo ?>
<?= $this->endSection(); ?>



<?= $this->section('estilos'); ?>

<link rel="stylesheet" href="<?= site_url("web/src/assets/css/produto.css")?>">

<?= $this->endSection(); ?>



<?= $this->section('conteudo'); ?>

<div class="container section" id="menu" data-aos="fade-up" style="margin-top:3em;">


    <div class="container">
        <!-- product -->
        <div class="product-content product-wrap clearfix product-deatil">
            <div class="row">
                <div class="col-md-5 col-sm-12 col-xs-12">
                    <div class="product-image">
                    <img src="<?= site_url("produto/imagem/$produto->imagem")?>" alt="<?= esc($produto->nome)?>" />
                    </div>
                </div>

                
      <?php if(session()->has('errors_model')) : ?>

<ul>
  <?php foreach (session('errors_model') as $error):?>

      <li class="text-danger"><?= $error ;?></li>

    <?php endforeach; ?>
</ul>

<?php endif;?>

                <?= form_open("carrinho/adicionar");?>

                <div class="col-md-6 col-md-offset-1 col-sm-12 col-xs-12">
                    <h2 class="name">
                        <?= esc($produto->nome)?>
              
                    </h2>
                    <hr />
                    <h3 class="price-container">

                    <p class="small">Escolha o valor</p>

                    <?php foreach($especificacoes as $especificacao):?>
                       <div class="radio">

                            <label style="font-size:16px;" for="<?= $especificacao->especificacao_id?>">
                                <input type="radio" id="<?= $especificacao->especificacao_id?>" class="especificacao" data-especificacao="<?= $especificacao->especificacao_id?>" name="produto[preco]" value="<?= $especificacao->preco?>">
                                <?= esc($especificacao->nome)?>
                                R$ <?= esc(number_format($especificacao->preco, 2))?>

                            </label>

                       </div>
                    <?php endforeach;?>



                    <?php if(isset($extras)):?>

                        <hr>

                        <p class="small">Extras do Produto</p>

                        <div class="radio">

                                <label style="font-size:16px;" for="semextra">
                                    <input type="radio" class="extra" id="semextra" checked="" name="extra">Sem Extra

                                </label>

                                </div>
                        
                        <?php foreach($extras as $extra):?>
                        <div class="radio">

                                <label style="font-size:16px;" for="extra<?= $extra->id_principal?>">
                                    <input type="radio" id="extra<?= $extra->id_principal?>" class="extra" data-extra="<?= $extra->id_principal?>" name="extra" value="<?= $extra->preco?>">
                                    <?= esc($extra->nome)?>
                                    R$ <?= esc(number_format($extra->preco, 2))?>

                                </label>

                        </div>
                        <?php endforeach;?>


                    <?php endif;?>


                        
                    </h3>

                    <div class="row" style="margin-top:4rem;">
                        <div class="col-md-4">
                            <label for="">Quantidade</label>
                            <input type="number" class="form-control" placeholder="Quantidade" name="produto[quantidade]" value="1" min="1" max="10" step="1" required=""> 
                        </div>
                    </div>

                    <hr />
                    <div class="description description-tabs">
                        <ul id="myTab" class="nav nav-pills">
                            <!-- <li class="active"><a href="#more-information" data-toggle="tab" class="no-margin">Detalhes </a></li> -->

                        </ul>
                        <div id="myTabContent" class="tab-content">
                            <div class="tab-pane fade active in" id="more-information">
                                <br />
                                <strong style="font-size:2em;">Informações</strong>
                                <p style="font-size:1.4em;">
                                  <?= esc($produto->ingredientes)?>
                                </p>
                            </div>
                            
                          
                        </div>
                    </div>
                    <hr />


                    <div>
                       <input type="text" placeholder="produto[slug]" name="produto[slug]" value="<?= $produto->slug?>">
                       <input type="text" placeholder="especificacao_id"  id="especificacao_id" name="produto[especificacao_id]" >
                       <input type="text" placeholder="extra_id" id="extra_id" name="produto[extra_id]" >



                    </div>

                    <div class="row">


                        <div class="col-md-4 ">
                            <input id="btn-adiciona" type="submit" class="btn btn-success btn-block" value="Adicionar ao Carrinho">                          
                        </div>

                        <?php foreach($especificacoes as $especificacao):?>

                            <?php if($especificacao->customizavel):?>
                                <div class="col-md-4 ">                            
                                    <a href="<?= site_url("produto/customizar/$produto->slug")?>" class="btn btn-primary  btn-block">Customizar</a>
                                </div>
                                <?php break;?>
                            <?php endif;?>
                        <?php endforeach;?>

                        <div class="col-md-4 ">                            
                            <a href="<?= site_url("/")?>" class="btn btn-info btn-block ">Mais produtos</a>
                        </div>


                       
                    </div>
                </div>

                <?= form_close();?>

            </div>
        </div>
        <!-- end product -->
    </div>


<div>


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

     
     
     
   