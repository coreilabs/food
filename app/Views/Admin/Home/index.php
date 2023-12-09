<?= $this->extend('Admin/layout/principal'); ?>


<?= $this->section('titulo'); ?>
<?= $titulo ?>
<?= $this->endSection(); ?>



<?= $this->section('estilos'); ?>
<?= $this->endSection(); ?>



<?= $this->section('conteudo'); ?>

<div class="row">


    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
        <div class="card-body dashboard-tabs p-0">

            <div class="tab-content py-0 px-0">
            <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                <div class="d-flex flex-wrap justify-content-xl-between">
                    <div class="d-flex d-xl-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                        <i class="mdi mdi-currency-usd icon-lg mr-3 text-primary"></i>
                        <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Pedidos Entregues
                                <span class="badge badge-pill badge-primary">
                                    <?= ($valorPedidosEntregues->total) ? $valorPedidosEntregues->total : '0' ?>
                                </span>
                            </small>
                            <h5 class="mr-2 mb-0">R$ <?= ($valorPedidosEntregues->total) ? number_format($valorPedidosEntregues->valor_pedido, 2, ',','.') : '0' ?></h5>
                        </div>
                    </div>
                    <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                        <i class="mdi mdi-currency-usd mr-3 icon-lg text-danger"></i>
                        <div class="d-flex flex-column justify-content-around">
                        <small class="mb-1 text-muted">Pedidos Cancelados
                                <span class="badge badge-pill badge-danger">
                                    <?= ($valorPedidosCancelados->total) ? $valorPedidosCancelados->total : '0' ?>
                                </span>
                            </small>
                            <h5 class="mr-2 mb-0">R$ <?= ($valorPedidosCancelados->total) ? number_format($valorPedidosCancelados->valor_pedido, 2, ',','.') : '0' ?></h5>
                       
                        </div>
                    </div>
                    <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                        <i class="mdi mdi-account-multiple mr-3 icon-lg text-success"></i>
                        <div class="d-flex flex-column justify-content-around">
                        <small class="mb-1 text-muted">Clientes Ativos</small>
                        <h5 class="mr-2 mb-0"><?= $totalClientesAtivos ?></h5>
                        </div>
                    </div>
                    <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                        <i class="mdi mdi-motorbike mr-3 icon-lg text-warning"></i>
                        <div class="d-flex flex-column justify-content-around">
                        <small class="mb-1 text-muted">Entregadores</small>
                        <h5 class="mr-2 mb-0"><?= $totalEntregadoresAtivos ?></h5>

                        </div>
                    </div>

                </div>
            </div>
     

            </div>
        </div>
        </div>
    </div>

    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
        <div class="card-body ">

        <?php $expedienteHoje = expedienteHoje();?>

        <?php if($expedienteHoje->situacao == false):?>

            <h4 class="text-danger"> <i class="mdi mdi-calendar-alert"></i> Não estamos Funcionando.</h4>

        <?php else:?>

           <div id="atualiza">
            <?php if(!isset($novosPedidos)):?>

                <h4 class="text-danger">Não há pedidos no momento.</h4>

                <?php else: ?>

                    <h2 class="text-center"><i class="mdi mdi-shopping"></i> Novos Pedidos</h2>
                    <hr>

                <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Código do Pedido</th>
                        <th>Valor</th>
                        <th>Data do Pedido</th>

                    </tr>
                    </thead>
                    <tbody>

                

                        <?php foreach($novosPedidos as $pedido):?>

                            <tr>
                                <td><a href="<?= site_url("admin/pedidos/show/$pedido->codigo")?>">  <?= $pedido->codigo;?></a></td>
                                <td>R$ <?= esc(number_format($pedido->valor_pedido,2,',', '.'));?></td>
                                <td><?= $pedido->criado_em->humanize();?></td>


                            </tr>

                        <?php endforeach; ?>




                    </tbody>
                </table>
                
                </div>

                    
                </div>

                <?php endif;?>
           </div>    <!-- fim div atualiza -->
         

        <?php endif;?>





        </div>
    </div>




    




    </div>

    <div class="row">
        <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                <p class="card-title">Produtos Mais Vendidos</p>
                            <ul class="list-arrow">

                                <?php if(!isset($produtosMaisVendidos)):?>

                                    <p>Não há dados para exibir</p>

                                <?php else:?>

                                    
                                <?php foreach($produtosMaisVendidos as $produto):?>
                                    <li class="mb-2">
                                        <?= word_limiter($produto->produto, 10)?>
                                        <span class="badge badge-pill badge-primary float-right"><?= esc($produto->quantidade)?></span>
                                    </li>
                                <?php endforeach;?>

                                <?php endif;?>

                            </ul>
               
                </div>
            </div>
        </div>

        <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                <p class="card-title">Top Clientes</p>
                            <ul class="list-arrow">

                                <?php if(!isset($clientesMaisAssiduos)):?>

                                    <p>Não há dados para exibir</p>

                                <?php else:?>

                                    
                                <?php foreach($clientesMaisAssiduos as $cliente):?>
                                    <li class="mb-2">
                                       <a href="<?= site_url("admin/usuarios/show/$cliente->id")?>">
                                            <?= esc($cliente->nome)?>
                                        </a> 
                                        <span class="badge badge-pill badge-success float-right"><?= esc($cliente->pedidos)?></span>
                                    </li>
                                <?php endforeach;?>

                                <?php endif;?>

                            </ul>
               
                </div>
            </div>
        </div>

        <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                <p class="card-title">Top Entregadores</p>
                            <ul class="list-unstyled">

                                <?php if(!isset($entregadoresMaisAssiduos)):?>

                                    <p>Não há dados para exibir</p>

                                <?php else:?>

                                    
                                <?php foreach($entregadoresMaisAssiduos as $entregador):?>
                                    <li class="mb-2">
                                       <a href="<?= site_url("admin/entregadores/show/$entregador->id")?>">
                                            <img class="rounded-circle" width="50px" src="<?= site_url("admin/entregadores/imagem/$entregador->imagem")?>" alt="">
                                            <?= esc($entregador->nome)?>
                                        </a> 
                                        <span class="badge badge-pill badge-warning float-right"><?= esc($entregador->entregas)?></span>
                                    </li>
                                <?php endforeach;?>

                                <?php endif;?>

                            </ul>
               
                </div>
            </div>
        </div>
    </div>

<?= $this->endSection(); ?>



<?= $this->section('scripts'); ?>

<script>

    setInterval("atualiza()", 30000); //30 seg

    function atualiza(){

        // $("#atualiza").toggleClass('bg-success');
        $("#atualiza").load('<?= site_url('admin/home')?>' + ' #atualiza');

    }

</script>
<?= $this->endSection(); ?>
