<?= $this->extend('layout/principal_web'); ?>


<?= $this->section('titulo'); ?>
<?= $titulo ?>
<?= $this->endSection(); ?>



<?= $this->section('estilos'); ?>
<?= $this->endSection(); ?>


<?= $this->section('conteudo'); ?>
<?= $this->include("carrossel"); ?>




  <!-- Begin Sections-->

   

        <!--    Menus   -->
        <div class="container section" id="menu" data-aos="fade-up" style="margin-top:3em;">

                    <?php if(empty($categorias)):?>

                        <div class="title-block">
                <h1 class="section-title">Nosso Cardápio</h1>
            </div>

                    <?php endif;?>

      

            <!--    Menus filter    -->
            <div class="menu_filter text-center">
                <ul class="list-unstyled list-inline d-inline-block">



                
            

                    <?php if(empty($categorias)):?>

          
                    <?php else:?>

                        <li id="todas" class="item active">
                        <a href="javascript:;" class="filter-button" data-filter="todas">Todas Categorias</a>
                    </li>

                        <?php foreach($categorias as $categoria) :?>

                            <li class="item">
                                <a href="javascript:;" class="filter-button" data-filter="<?= $categoria->slug?>"><?= $categoria->nome?></a>
                            </li>

                        <?php endforeach;?>

                    <?php endif;?>



      






                </ul>
            </div> 

            <!--    Menus items     -->
            <div id="menu_items">

            <div class="row">

                <?php if(empty($produtos)):?>

                <h3 class="section-title text-center">Não há produtos cadastrados</h3>

                <?php else:?>

                    <?php foreach($produtos as $produto):?>

                        <div class="col-sm-6 filtr-item image filter active <?= $produto->categoria_slug?>">
                            <a href="<?= site_url("produto/detalhes/$produto->slug")?>" class="block fancybox" data-fancybox-group="fancybox">
                                <div class="content">
                                    <div class="filter_item_img">
                                        <i class="fa fa-search-plus"></i>
                                        <img src="<?= site_url("produto/imagem/$produto->imagem")?>" alt="<?= esc($produto->nome)?>" />
                                    </div>
                                    <div class="info">
                                        <div class="name"><?= esc($produto->nome)?></div>
                                        <div class="short"><?= word_limiter($produto->ingredientes, 5)?></div>
                                        <span class="filter_item_price">A partir de <?= esc(number_format($produto->preco,2,',', '.'))?></span>
                                    </div>
                                </div>
                            </a>
                        </div>

                    <?php endforeach;?>


                <?php endif;?>





            </div>




            </div>
        </div>

        <!--    Reservation    -->

        


  
        <!-- End Sections -->




<?= $this->endSection(); ?>



<?= $this->section('scripts'); ?>
<?= $this->endSection(); ?>

     
     
     
   