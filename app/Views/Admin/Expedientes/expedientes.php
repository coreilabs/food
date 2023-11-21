<?= $this->extend('Admin/layout/principal'); ?>


<?= $this->section('titulo'); ?>
<?= $titulo ?>
<?= $this->endSection(); ?>


<?= $this->section('conteudo'); ?>



<div class="row">
           
            <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
  <div class="card-header bg-primary pn-0 pt-4">
  <h2 class="card-title text-white"><?= esc($titulo) ?></h2>


</div>


<?php if(session()->has('errors_model')) : ?>

<ul>
  <?php foreach (session('errors_model') as $error):?>

      <li class="text-danger"><?= $error ;?></li>

    <?php endforeach; ?>
</ul>

<?php endif;?>
                <div class="card-body">


      
<?php echo form_open("admin/expedientes/expedientes", ['class'=> 'form-row'] ); ?>



<div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>Dia</th>
                          <th>Abertura</th>
                          <th>Fechamento</th>
                          <th>Situação</th>

                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach($expedientes as $dia):?>

                            <tr>

                              <td class="form-group col-md-3">
                                
                              <input type="text" name="dia_descricao[]" class="border-0" value="<?= esc($dia->dia_descricao)?>" readonly="">

                              </td>

                              <td class="form-group col-md-2">
                                
                                <input type="time" name="abertura[]" class="form-control" value="<?= esc($dia->abertura)?>" required="">
  
                              </td>

                              
                              <td class="form-group col-md-2">
                                
                                <input type="time" name="fechamento[]" class="form-control" value="<?= esc($dia->fechamento)?>" required="">
  
                              </td>
                              <td class="form-group col-md-3">

                              <select name="situacao[]" class="form-control" id="" required="">

                                <option value="1">Aberto</option>
                                <option value="0">Fechado</option>

                              </select>
                                
                              
  
                              </td>


                               
                            </tr>
                            
                        <?php endforeach; ?>

 

                      </tbody>
        
                    </table>

                    <button type="submit"  class="btn btn-dark btn-icon-text btn-sm  m-1">
                        <i class="mdi mdi-content-save btn-icon-prepend"></i>
                        Salvar
                      </button>
      
                  </div>



                  <?php echo form_close(); ?>


            

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
                    url: "<?php echo site_url('admin/bairros/procurar'); ?> ",
                    dataType: "json",
                    data:{
                        term: request.term
                    },
                    success: function (data) {
                        if(data.length < 1){
                            var data = [{
                                label: 'Bairro não encontrado',
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
                    window.location.href = '<?php echo site_url('admin/bairros/show/')?>' + ui.item.id;
                }
            }
        }); // fim auto-complete
    });
</script>
<?= $this->endSection(); ?>
