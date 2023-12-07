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

            <?php if($pedido->situacao == 0) : ?>
                <div class="col-xs-12 col-md-12 col-lg-12">

                    <h2 class="section-title"><?= esc($titulo)?></h2>    
                        
                </div>
            <?php endif;?>

            <div class="col-md-12 col-xs-12 text-center">
            <h4>No momento o seu pedido esta com o status de <?= $pedido->exibeSituacaoDoPedido()?></h4>
            </div>

            <?php if($pedido->situacao != 3) : ?>
                <div class="col-xs-12 col-md-12 col-lg-12">

                    <h4 class="text-center">Quando ocorrer uma mudança no status do seu pedido, nós notificaremos você por email</h4> 

                        
                </div>
            <?php endif;?>

        <div class="col-md-12">

            <ul class="list-group">

        

                <?php foreach($produtos as $produto):?>



                <li class="list-group-item">
                    <div>
                        <h4><?= ellipsize($produto['nome'], 100) ?></h4>
                        <p class="text-muted">Quantidade: <?= $produto['quantidade']?></p>
                        <p class="text-muted">Preço: R$ <?=  number_format($produto['preco'], 2, ',', '.')?></p>
                       


                    </div>
                </li>

                <?php endforeach;?>

                <li class="list-group-item">
                    <span>Data do Pedido: </span>
                    <strong><?= $pedido->criado_em->humanize() ?></strong>
                </li>
                <li class="list-group-item">
                    <span>Total de Produtos: </span>
                    <strong><?= 'R$ ' . number_format($pedido->valor_produtos, 2, ',', '.')?></strong>
                </li>

                <li class="list-group-item">
                    <span>Taxa de Entrega: </span>
                    <strong><?= 'R$ ' . number_format($pedido->valor_entrega, 2, ',', '.')?></strong>
                </li>
                <li class="list-group-item">
                    <span>Valor final do Pedido: </span>
                    <strong><?= 'R$ ' . number_format($pedido->valor_pedido, 2, ',', '.')?></strong>
                </li>

                <li class="list-group-item">
                    <span>Endereço de Entrega: </span>
                    <strong><?= esc($pedido->endereco_entrega)?></strong>
                </li>
                <li class="list-group-item">
                    <span>Forma de Pagamento: </span>
                    <strong><?= esc($pedido->forma_pagamento)?></strong>
                </li>
                <li class="list-group-item">
                    <span>Observações do Pedido: </span>
                    <strong><?= esc($pedido->observacoes)?></strong>
                </li>

            </ul>

            <a href="<?php echo site_url("/"); ?>" class="btn btn-food " >Ver Mais Produtos</a>




              </div> <!-- fim col-md-12  -->




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

    $("#btn-checkout").prop('disabled', true);
    

    $(".forma").on('click', function(){
        var forma_id = $(this).attr('data-forma');
        $("#forma_id").val(forma_id);

        if(forma_id == 1){

            $("#troco").removeClass('hidden');

        }else{
            $("#troco").addClass('hidden');

        }

    }); //fim troco



    $("#sem_troco").on('click', function(){

        if(this.checked){
            $('#troco_para').prop('disabled', true);
            $('#troco_para').val('Não preciso de Troco');
            $('#troco_para').attr('placeholder', 'Não Preciso de troco');

        }else{

            $('#troco_para').prop('disabled', false);
            $('#troco_para').attr('placeholder', 'Enviar Troco Para');
            $('#troco_para').val('');
        }


}); //fim sem troco


    $("[name=cep]").focusout(function(){
        var cep = $(this).val();
        if(cep.length === 9){

            $.ajax({
                type: 'get',
                url:'<?= site_url('checkout/consultacep')?>',
                dataType: 'json',
                data:{
                    cep:cep
                },
                beforesend: function(){
                    $("#cep").html('Consultando CEP');
                    $("[name=cep]").val('');
                    $("#btn-checkout").prop('disabled', true);
                    $("#btn-checkout").val('Consultando Taxa de Entrega...');
                },
                success: function(response){
                   if(!response.erro){
                        // cep valido              

                        $("#valor_entrega").html(response.valor_entrega);
                        $("#bairro_slug").val(response.bairro_slug);

                        $("#btn-checkout").prop('disabled', false);
                        $("#btn-checkout").val('Processar Pedido');
                        if(response.logradouro){
                            $("#rua").val(response.logradouro);


                        }else{
                            $('#rua').prop('readonly', false);
                        }

                        $("#endereco").html(response.endereco);

                        $("#total").html(response.total);
                        $("#cep").html(response.bairro);


                   }else{
                    // erro de validacao
                    $("#cep").html(response.erro);
                    $("#btn-checkout").prop('disabled', true);
                    $("#btn-checkout").val('Consulte a Taxa de Entrega');
                   }
                },
                error:function(){
                    alert('Não foi possível consultar a taxa de entrega. Por favor entre em contato com nossa equipe e informe o erro: CONSULTA-ERRO-TAXA-ENTREGA-CHECKOUT');

                    $("#btn-checkout").prop('disabled', true);
                    $("#btn-checkout").val('Consulte a Taxa de Entrega');
                }

            })

        }
    });

    $("form").submit(function() {
        $(this).find(":submit").attr('disabled', 'disabled');
        $("#btn-checkout").val('Processando o seu pedido');
        $("#cep").val('');
    });

    $(window).keydown(function(event){

        if(event.keyCode == 13){
            event.preventDefault();
            return false;
        }

    });
   
</script>
<?= $this->endSection(); ?>

     
     
     
   