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
                 

                  <div class="row" style="min-height:500px;">

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

                    <div id="imagemPrimeiroProduto" style="margin-bottom:1em;">

                        <img class="img-responsive center-block d-block mx-auto"  src="<?= site_url('admin/images/sem-imagem.webp')?>" width="200" alt="Escolha o produto"/>

                    </div>
                    
                    <label for="">Escolha a primeira metade</label>
                    <select name="primeira_metade" id="primeira_metade" class="form-control">
                        <option value="">Escolha seu produto</option>
                        <?php foreach($opcoes as $opcao):?>

                        <option value="<?= $opcao->id?>"><?= esc($opcao->nome)?></option>


                        <?php endforeach;?>
                    </select>

                    </div>

                    <div class="col-md-6" >

                    <div id="imagemSegundoProduto" style="margin-bottom:1em;">
                    
                        <img class="img-responsive center-block d-block mx-auto"  src="<?= site_url('admin/images/sem-imagem.webp')?>" width="200" alt="Escolha o produto"/>

                    </div>

                    
                    <label for="">Escolha a segunda metade</label>
                    <select name="segunda_metade" id="segunda_metade" class="form-control">
                       
                    <!-- aqui serao renderizadas as opcoes para compor a segunda metade, via javascript -->
                        
                    </select>

                    </div>
                        

                      </div>

                      <div class="row">
                        <div class="col-sm-3">

                            <input id="btn-adiciona" type="submit" class="btn btn-success btn-block "
                                value="Adicionar ao carrinho">

                            </div>


                            <!-- Colocando o botão customizavel para aparecer somento se o item for customizavel -->
                            

                            <div class="col-sm-3">

                            <a href="<?php echo site_url("produto/detalhes/$produto->slug"); ?>" class="btn btn-info btn-block ">Voltar</a>
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

        $('#btn-adiciona').prop("disabled", true);
        $('#btn-adiciona').prop("value", "Selecione um tamanho");


        $("#primeira_metade").on('change', function(){

            var primeira_metade = $(this).val();
            var categoria_id =  '<?= $produto->categoria_id ?>';

            $("#imagemPrimeiroProduto").html(' <img class="img-responsive center-block d-block mx-auto"  src="<?= site_url('admin/images/sem-imagem.webp')?>" width="200" alt="Escolha o produto"/>');
            
            if(primeira_metade){

             $.ajax({

                type: 'get',
                url: '<?= site_url('produto/procurar')?>',
                dataType: 'json',
                data: {
                    primeira_metade: primeira_metade,
                    categoria_id: categoria_id,

                },
                beforeSend: function(data){

                    $("#segunda_metade").html('');

                },
                success: function(data){


                    if(data.imagemPrimeiroProduto){

                        $("#imagemPrimeiroProduto").html(' <img class="img-responsive center-block d-block mx-auto"  src="<?= site_url('produto/imagem/')?>'+ data.imagemPrimeiroProduto +'" width="200" alt="Escolha o produto"/>');

                    }

                    if(data.produtos){

                        $("#segunda_metade").html('<option>Escolha a segunda metade</option>');

                        $(data.produtos).each(function(){

                            var option = $('<option />');
                            option.attr('value', this.id).text(this.nome);
                            $("#segunda_metade").append(option);

                        });

                    }else{

                        $("#segunda_metade").html('<option>Não encontramos opções de customização</option>');

                    }
                    
                },


             });



            }else{
                /**
                 * cliente nao escolheu a primeira metade
                 */
                $("#segunda_metade").html('<option>Escolha a primeira metade</option>');

            }

        });


        $("#segunda_metade").on('change', function(){

            var primeiro_produto_id = $("#primeira_metade").val();
            var segundo_produto_id = $(this).val();

            $("#imagemSegundoProduto").html(' <img class="img-responsive center-block d-block mx-auto"  src="<?= site_url('admin/images/sem-imagem.webp')?>" width="200" alt="Escolha o produto"/>');

            if(primeiro_produto_id && segundo_produto_id){

                $.ajax({

                    type: 'get',
                    url: '<?= site_url('produto/exibetamanhos')?>',
                    dataType: 'json',
                    data: {
                        primeiro_produto_id: primeiro_produto_id,
                        segundo_produto_id: segundo_produto_id,

                    },
                    beforeSend: function(data){

        

                    },
                    success: function(data){

                        if(data.imagemSegundoProduto){

                            $("#imagemSegundoProduto").html(' <img class="img-responsive center-block d-block mx-auto"  src="<?= site_url('produto/imagem/')?>'+ data.imagemSegundoProduto +'" width="200" alt="Escolha o produto"/>');

                        }

                        
                        
                    },


                });

            }
        

        });
            

        });

</script>
<?= $this->endSection(); ?>

     
     
     
   