<?= $this->extend('Admin/layout/principal'); ?>


<?= $this->section('titulo'); ?>
<?= $titulo ?>
<?= $this->endSection(); ?>



<?= $this->section('estilos'); ?>



<link rel="stylesheet" href="<?= site_url('admin/vendors/auto-complete/jquery-ui.css'); ?>">


<?= $this->endSection(); ?>



<?= $this->section('conteudo'); ?>



<div class="row">
           
            <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
  <div class="card-header bg-primary pn-0 pt-4">
  <h2 class="card-title text-white"><?= esc($titulo) ?></h2>

</div>
                <div class="card-body">


                    <div class="ui-widget" >
                      <input id="query" placeholder="Pesquise por código de Pedido " class="form-control bg-light mb-5">
                    </div>

                    <?php if(!isset($pedidos)):?>

                      <h3>Não há dados para exibir</h3>

                    <?php else:?>

                      <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>Código do Pedido</th>
                          <th>Data do Pedido</th>
                          <th>Cliente</th>
                          <th>Valor</th>
                          <th>Situação</th>

                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach($pedidos as $pedido):?>

                            <tr>
                                <td><a href="<?= site_url("admin/pedidos/show/$pedido->codigo")?>">  <?= $pedido->codigo;?></a></td>
                                <td><?= $pedido->criado_em->humanize();?></td>
                                <td><?= $pedido->cliente;?></td>
                                <td>R$ <?= esc(number_format($pedido->valor_pedido,2,',', '.'));?></td>
                                <td><?= $pedido->exibeSituacaoDoPedido();?></td>

                            </tr>
                            
                        <?php endforeach; ?>

                      </tbody>
                    </table>
                    <div class="mt-3">
                      <?= $pager->links()?>
                    </div>
                  </div>

                    <?php endif;?>


                  <!-- <p class="card-description">
                    Add class <code>.table-hover</code>
                  </p> -->
            
                </div>
              </div>
            </div>
            

          </div>


<?= $this->endSection(); ?>



<?= $this->section('scripts'); ?>
<script src="<?= site_url('admin/vendors/auto-complete/jquery-ui.js');?>"></script>
<script>
    $(function (){
        $( "#query" ).autocomplete({
            source: function (request, response){
                $.ajax({
                    url: "<?php echo site_url('admin/pedidos/procurar'); ?> ",
                    dataType: "json",
                    data:{
                        term: request.term
                    },
                    success: function (data) {
                        if(data.length < 1){
                            var data = [{
                                label: 'Pedido não encontrado',
                                value: -1,
                                }
                            ];
                        }
                        response(data); //retorno com valor da busca
                    }
                }); // fim Ajax
            },
            minLength: 1,
            select: function (event, ui) {
                if(ui.item.value == -1){
                    $(this).val("");
                    return false;
                }else {
                    window.location.href = '<?php echo site_url('admin/pedidos/show/')?>' + ui.item.id;
                }
            }
        }); // fim auto-complete
    });
</script>
<?= $this->endSection(); ?>
