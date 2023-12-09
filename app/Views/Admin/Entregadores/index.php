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
                      <input id="query" placeholder="Pesquise um Entregador" class="form-control bg-light mb-5">
                    </div>

                    <a href="<?= site_url("admin/entregadores/criar")?>" class="btn btn-success btn-sm  btn-icon-text  m-1 float-right mb-5">
  <i class="btn-icon-prepend mdi mdi-plus"></i> Cadastrar</a>

                  <!-- <p class="card-description">
                    Add class <code>.table-hover</code>
                  </p> -->

                  <?php if(empty($entregadores)):?>

                  <h3>Não há dados para exibir</h3>

                  <?php else:?>

                    <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>Imagem</th>
                          <th>Nome</th>
                          <th>Telefone</th>
                          <th>Placa</th>
                          <th>Ativo</th>
                          <th>Situação</th>

                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach($entregadores as $entregador):?>

                            <tr>

                            <td class="py-1">

                            <?php if($entregador->imagem) :?>
                            <img src="<?= site_url('admin/')?>entregadores/imagem/<?= $entregador->imagem?>" alt="<?= $entregador->nome?>"/>
                            <?php else:?>
                              <img src="<?= site_url('admin/images/sem-imagem.webp')?>" alt="Entregador sem imagem"/>

                            <?php endif;?>
                          </td>

                                <td><a href="<?= site_url("admin/entregadores/show/$entregador->id")?>">  <?= $entregador->nome;?></a>
                                
                                </td>
                                <td><?= $entregador->telefone;?></td>
                                <td><?= $entregador->placa;?></td>
                 
                                
                                <td><?php echo ($entregador->ativo && $entregador->deletado_em == null ? '<label class="badge badge-primary">Sim</label>' : '<label class="badge badge-danger">Não</label>')?></td>
                                
                                <td>
                                  
                                <?php echo ($entregador->deletado_em == null ? '<label class="badge badge-primary">Disponível</label>' : '<label class="badge badge-danger">Excluído</label>')?>
                              
                                <?php if($entregador->deletado_em != null ): ?>
                                  <a href="<?= site_url("admin/entregadores/desfazerexclusao/$entregador->id")?>" class="badge badge-dark ml-2  ">
  <i class="btn-icon-prepend mdi mdi-undo"></i> Desfazer</a>
                                  <?php endif;?>

                              </td>
                            </tr>
                            
                        <?php endforeach; ?>

                      </tbody>
                    </table>
                    <div class="mt-3">
                      <?= $pager->links()?>
                    </div>
                  </div>

                  <?php endif;?>

         
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
                    url: "<?php echo site_url('admin/entregadores/procurar'); ?> ",
                    dataType: "json",
                    data:{
                        term: request.term
                    },
                    success: function (data) {
                        if(data.length < 1){
                            var data = [{
                                label: 'Entregador não encontrado',
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
                    window.location.href = '<?php echo site_url('admin/entregadores/show/')?>' + ui.item.id;
                }
            }
        }); // fim auto-complete
    });
</script>
<?= $this->endSection(); ?>
