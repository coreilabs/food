<?= $this->extend('layout/principal_web'); ?>


<?= $this->section('titulo'); ?>
<?= $titulo ?>
<?= $this->endSection(); ?>



<?= $this->section('estilos'); ?>

<link rel="stylesheet" href="<?= site_url("web/src/assets/css/conta.css")?>">

<?= $this->endSection(); ?>



<?= $this->section('conteudo'); ?>

<div class="container section" id="menu" data-aos="fade-up" style="margin-top: 3em;min-height:300px">


    <?= $this->include("Conta/sidebar") ?>
    <div class="row">
    <h2 class="section-title"><?= esc($titulo)?></h2>    

        <div class="col-md-6 col-md-offset-3">

            <?php if(!isset($pedidos)) :?>

                <h3 class="text-center">Histórico de Pedidos Vazio</h3>

            <?php else: ?>

                <?php foreach($pedidos as $key => $pedido):?>

                    <div class="panel-group">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" href="#collapse<?= $key?>">Pedido <?= esc($pedido->codigo)?> - Realizado: <?= esc($pedido->criado_em->humanize())?> </a>
                                </h4>
                            </div>
                            <div id="collapse<?= $key?>" class="panel-collapse collapse">
                  
                                <div class="panel-body">
                                <h5>Situação do pedido: <?= $pedido->exibeSituacaoDoPedido()?></h5>
                                      
                                    <ul class="list-group">

                                <?php $produtos = unserialize($pedido->produtos);?>

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


                                </div>
                               
                            </div>
                        </div>
                    </div>
                <?php endforeach;?>

            <?php endif; ?>

        </div>
    </div>

</div>

<?= $this->endSection(); ?>



<?= $this->section('scripts'); ?>

<script>

                    /* Set the width of the sidebar to 250px and the left margin of the page content to 250px */
                    function openNav() {
        document.getElementById("mySidebar").style.width = "250px";
        document.getElementById("main").style.marginLeft = "250px";
        document.getElementById("openbtn").style.display = "none";

        }

        /* Set the width of the sidebar to 0 and the left margin of the page content to 0 */
        function closeNav() {
        document.getElementById("mySidebar").style.width = "0";
        document.getElementById("main").style.marginLeft = "0";
        document.getElementById("openbtn").style.display = "initial";

        }


    $(document).ready(function(){


      
    });
</script>
<?= $this->endSection(); ?>

     
     
     
   