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

              <?php if(!isset($carrinho)):?>

                <div class="text-center">
                    <h2 class="text-center">Seu carrinho de compras está vazio.</h2>
                    <a href="<?php echo site_url("/"); ?>" class="btn btn-lg " style="background-color: #990100;color:white; margin-top:2em;">Ver produtos</a>
                </div>

                

                <?php else:?>

                <div class="table-responsive">

                <h4 class="text-center" style="margin-bottom:2em">Resumo do Carrinho de Compras</h4>

                <?php if(session()->has('errors_model')) : ?>

                    <ul style="list-style:decimal">
                    <?php foreach (session('errors_model') as $error):?>

                        <li class="text-danger"><?= $error ;?></li>

                        <?php endforeach; ?>
                </ul>

                <?php endif;?>

                    <table class="table table-hover">
            
                        <thead>
                            <tr>
                            <th class="text-center" scope="col">Remover</th>
                            <th scope="col">Produto</th>
                            <th scope="col">Tamanho</th>
                            <th  class="text-center" scope="col">Quantidade</th>
                            <th scope="col">Preço</th>
                            <th scope="col">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php $total = 0; ?>

                            <?php foreach($carrinho as $produto):?>

                            <tr>
                            <th class="text-center" scope="row">

                            <?= form_open("carrinho/remover", ['class' => 'form-inline'])?>
                                <div class="form-group">
                                <input type="hidden" name="produto[slug]" value="<?= esc($produto->slug)?>">
                                </div>

                                <button type="submit" class="btn btn-danger float-right">
                                    <i class="fa fa-trash"></i>
                                </button>
                                <?= form_close();?>


                               
                            </th>
                            <td ><?= esc($produto->nome)?></td>
                            <td><?= esc($produto->tamanho)?></td>
                            <td class="text-center">
                                <?= form_open("carrinho/atualizar", ['class' => 'form-inline'])?>
                                <div class="form-group">
                                <input type="number" class="form-control" name="produto[quantidade]" value="<?= esc($produto->quantidade)?>" min="1" max="10" step="1" required="">
                                <input type="hidden" name="produto[slug]" value="<?= esc($produto->slug)?>">
                                </div>

                                <button type="submit" class="btn btn-primary float-right">
                                    <i class="fa fa-refresh"></i>
                                </button>
                                <?= form_close();?>
                            </td>
                            <td>R$ <?= esc($produto->preco)?></td>

                            <?php 
                                    $subTotal = $produto->preco * $produto->quantidade;
                                    $total += $subTotal
                                ?>

                            <td>R$ <?= number_format($subTotal, 2)?></td>
                            </tr>

                            <?php endforeach;?>

                            <tr>
                                <td class="text-right " colspan="5" style="font-weight:bold;border-top:0">Total Produtos:</td>
                                <td style="border-top:0" colspan="5">R$ <?= number_format($total, 2)?></td>
                            </tr>
                            <tr>
                                <td class="text-right border-0" colspan="5" style="font-weight:bold;border-top:0">Taxa de Entrega:</td>
                                <td class="border-top-0" id="valor_entrega" style="border-top:0"colspan="5">Não calculado</td>
                            </tr>
                            <tr>
                                <td class="text-right border-0" colspan="5" style="font-weight:bold;border-top:0">Total do Pedido:</td>
                                <td class="border-top-0" id="total" style="border-top:0" colspan="5">R$ <?= number_format($total, 2)?></td>
                            </tr>
                            
                        </tbody>
                        
                    </table>

                    <div class="form-group col-md-4">
                        <label>Consulte a Taxa de Entrega</label>
                        <input type="text" name="cep" class="form-control cep" placeholder="Informe seu CEP" >
                        <div id="cep"></div>
                    </div>
              </div>

              <hr>

              <div class="col-md-12">
              <a href="<?php echo site_url("carrinho/limpar"); ?>" class="btn btn-default " style="font-family:'Montserrat-Bold';">Limpar Carrinho</a>
              <a href="<?php echo site_url("/"); ?>" class="btn btn-primary" style="font-family:'Montserrat-Bold';">Ver Produtos</a>
              <a href="<?php echo site_url("checkout"); ?>" class="btn pull-right" style="background-color:#990100;font-family:'Montserrat-Bold';color:white;">Finalizar Pedido</a>



              </div>

              <?php endif;?>



          </div>
      </div>
      <!-- end product -->
  </div>

<?= $this->endSection(); ?>



<?= $this->section('scripts'); ?>

<script src="<?= site_url('admin/vendors/mask/jquery.mask.min.js')?>"></script>
<script src="<?= site_url('admin/vendors/mask/app.js')?>"></script>
<script>

    $("[name=cep]").focusout(function(){
        var cep = $(this).val();
        if(cep.length === 9){

            $.ajax({
                type: 'get',
                url:'<?= site_url('carrinho/consultacep')?>',
                dataType: 'json',
                data:{
                    cep:cep
                },
                beforesend: function(){
                    $("#cep").html('Consultando CEP');
                    $("[name=cep]").val('');
                },
                success: function(response){
                   if(!response.erro){
                        // cep valido

                        $("#cep").html('');

                        $("#valor_entrega").html(response.valor_entrega);
                        $("#total").html(response.total);
                        $("#cep").html(response.bairro);





                   }else{
                    // erro de validacao
                    $("#cep").html(response.erro);
                   }
                },
                error:function(){
                    alert('Não foi possível consultar a taxa de entrega. Por favor entre em contato com nossa equipe e informe o erro: CONSULTA-ERRO-TAXA-ENTREGA');
                }

            })

        }
    });
   
</script>
<?= $this->endSection(); ?>

     
     
     
   