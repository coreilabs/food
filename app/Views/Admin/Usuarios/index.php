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
                      <input id="query" placeholder="Pesquise um Usuário" class="form-control bg-light mb-5">
                    </div>

                  <!-- <p class="card-description">
                    Add class <code>.table-hover</code>
                  </p> -->
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>Nome</th>
                          <th>Email</th>
                          <th>CPF</th>
                          <th>Ativo</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach($usuarios as $usuario):?>

                            <tr>
                                <td><a href="<?= site_url("admin/usuarios/show/$usuario->id")?>">  <?= $usuario->nome;?></a>
                                
                                </td>
                                <td><?= $usuario->email;?></td>
                                <td><?= $usuario->cpf;?></td>
                 
                                
                                <td><?php echo ($usuario->ativo ? '<label class="badge badge-primary">Sim</label>' : '<label class="badge badge-danger">Não</label>')?></td>
                            </tr>
                            
                        <?php endforeach; ?>

                      </tbody>
                    </table>
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
                    url: "<?php echo site_url('admin/usuarios/procurar'); ?> ",
                    dataType: "json",
                    data:{
                        term: request.term
                    },
                    success: function (data) {
                        if(data.length < 1){
                            var data = [{
                                label: 'Usuario não encontrado',
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
                    window.location.href = '<?php echo site_url('admin/usuarios/show/')?>' + ui.item.id;
                }
            }
        }); // fim auto-complete
    });
</script>
<?= $this->endSection(); ?>
