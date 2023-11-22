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

                <?= form_open("carrinho/adicionar");?>

                <div class="col-md-6 col-md-offset-1 col-sm-12 col-xs-12">
                    <h2 class="name">
                        <?= esc($produto->nome)?>
              
                    </h2>
                    <hr />
                    <h3 class="price-container">
                        R$ 25,00
                        
                    </h3>

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
                        <div class="col-sm-12 col-md-6 col-lg-6">

                        <input type="submit" class="btn btn-success btn-lg" value="Adicionar ao Carrinho">
                            <a href="<?= site_url("/")?>" class="btn btn-info btn-lg">Mais produtos</a>
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
<?= $this->endSection(); ?>

     
     
     
   