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

        <div class="col-xs-12 col-md-12 col-lg-12">
            <h2 class="section-title"><?= esc($titulo)?></h2>    
                
        </div>

        <div class="col-md-7">

            <ul class="list-group">

                <?php $total = 0; ?>

                <?php foreach($carrinho as $produto):?>

                    <?php $subTotal = $produto['preco'] * $produto['quantidade'];?>

                    <?php $total += $subTotal;?>

                <li class="list-group-item">
                    <div>
                        <h4><?= ellipsize($produto['nome'], 60) ?></h4>
                        <p class="text-muted">Quantidade: <?= $produto['quantidade']?></p>
                        <p class="text-muted">Preço: R$ <?=  number_format($produto['preco'], 2, ',', '.')?></p>
                        <p class="text-muted">Subtotal: R$ <?= number_format($subTotal, 2, ',', '.') ?></p>


                    </div>
                </li>

                <?php endforeach;?>

                <li class="list-group-item">
                    <span>Total de Produtos: </span>
                    <strong><?= 'R$ ' . number_format($total, 2, ',', '.')?></strong>
                </li>

                <li class="list-group-item">
                    <span>Taxa de Entrega: </span>
                    <strong id="valor_entrega" class="text-danger">Obrigatório *</strong>
                </li>

                <li class="list-group-item">
                    <span>Valor do Pedido: </span>
                    <strong id="total" ><?= 'R$ ' . number_format($total, 2, ',', '.')?></strong>
                </li>

                <li class="list-group-item">
                    <span>Endereço de Entrega: </span>
                    <strong id="endereco" class="text-danger">Obrigatório *</strong>
                </li>

            </ul>

            <a href="<?php echo site_url("/"); ?>" class="btn btn-food " >Ver Mais Produtos</a>
              <a href="<?php echo site_url("carrinho"); ?>" class="btn btn-primary" style="font-family:'Montserrat-Bold';">Ver Carrinho de Compras</a>



              </div> <!-- fim col-md-7  -->

              <div class="col-md-5">
                <?php echo form_open('checkout/processar', ['id' => 'form-checkout']);?>

                <h4>Escolha a forma de Pagamento</h4>

                    <div class="form-row">
                        <?php foreach ($formas as $forma) : ?>
                            <div class="radio">

                                <label style="font-size: 16px" ;>

                                    <input id="forma" type="radio" name="forma" style="margin-top: 2px" class="forma" data-forma="<?= $forma->id?>">
                                    <?= esc($forma->nome)?>

                                    
                                </label>

                            </div>

                        <?php endforeach; ?>

                        <hr>

                        <div id="troco" class="">

                            <div class="form-group col-md-12">
                                <label>Troco Para</label>
                                <input type="text" id="troco_para" name="checkout['troco_para']" class="form-control money" placeholder="Troco Para">

                                <label >
                                    <input type="checkbox" id="sem_troco" name="checkout[sem_troco]">
                                    Não Precisa de Troco
                                </label>
                            </div>

                        </div>

                        <div class="form-group col-md-12">
                            <label >Consulte a Taxa de Entrega</label>
                            <input type="text" name="cep" class="form-control cep" placeholder="Informe Seu CEP" value="">
                            <div id="cep"></div>
                        </div>
                        <div class="form-group col-md-9">
                            <label >Rua</label>
                            <input type="text" name="checkout[rua]" class="form-control" readonly="" required="">
                        </div>
                        <div class="form-group col-md-3">
                            <label >Número *</label>
                            <input type="text" name="checkout[numero]" class="form-control" required="">
                        </div>
                        <div class="form-group col-md-12">
                            <label >Ponto de Referência *</label>
                            <input type="text" name="checkout[referencia]" class="form-control"  required="">
                        </div>

                        <div class="form-group col-md-12">
                            <input type="text" id="forma_id" name="checkout[forma_id]" placeholder="checkout[forma_id]">
                            <input type="text" id="bairro_slug" name="checkout[bairro_slug]" placeholder="checkout[bairro_slug]">
                        </div>
                    </div>

                    <div class="form-group col-md-12">
                            <input type="submit" id="btn_checkout" class="btn btn-food btn-block" value="Antes consulte a Taxa de Entrega" placeholder="checkout[forma_id]">
                            
                        </div>


                <?php form_close();?>
              </div>



            </div>
        </div>
      <!-- end product -->
  </div>
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

     
     
     
   