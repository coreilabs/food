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
                      <input id="query" placeholder="Pesquise por uma forma de pagamento" class="form-control bg-light mb-5">
                    </div>

                    <a href="<?= site_url("admin/formas/criar")?>" class="btn btn-success btn-sm  btn-icon-text  m-1 float-right mb-5">
  <i class="btn-icon-prepend mdi mdi-plus"></i> Cadastrar</a>

                  <!-- <p class="card-description">
                    Add class <code>.table-hover</code>
                  </p> -->
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>Nome</th>
          
                          <th>Data de Criação</th>
                          <th>Ativo</th>
                          <th>Situação</th>

                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach($formas as $forma):?>

                            <tr>
                                <td><a href="<?= site_url("admin/formas/show/$forma->id")?>">  <?= $forma->nome;?></a></td>
                   
                                <td><?= $forma->criado_em->humanize();?></td>
                             
                 
                                
                                <td><?php echo ($forma->ativo && $forma->deletado_em == null ? '<label class="badge badge-primary">Sim</label>' : '<label class="badge badge-danger">Não</label>')?></td>
                                
                                <td>
                                  
                                <?php echo ($forma->deletado_em == null ? '<label class="badge badge-primary">Disponível</label>' : '<label class="badge badge-danger">Excluído</label>')?>
                              
                                <?php if($forma->deletado_em != null ): ?>
                                  <a href="<?= site_url("admin/formas/desfazerexclusao/$forma->id")?>" class="badge badge-dark ml-2  ">
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
                    url: "<?php echo site_url('admin/formas/procurar'); ?> ",
                    dataType: "json",
                    data:{
                        term: request.term
                    },
                    success: function (data) {
                        if(data.length < 1){
                            var data = [{
                                label: 'Forma de pagamento não encontrada',
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
                    window.location.href = '<?php echo site_url('admin/formas/show/')?>' + ui.item.id;
                }
            }
        }); // fim auto-complete
    });
</script>
<?= $this->endSection(); ?>
