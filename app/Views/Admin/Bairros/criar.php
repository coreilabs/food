<?= $this->extend('Admin/layout/principal'); ?>


<?= $this->section('titulo'); ?>
<?= $titulo ?>
<?= $this->endSection(); ?>



<?= $this->section('estilos'); ?>






<?= $this->endSection(); ?>



<?= $this->section('conteudo'); ?>

<div class="row">
           
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
    <div class="card-header bg-primary pn-0 pt-4">
  <h2 class="card-title text-white"><?= esc($titulo) ?></h2>

</div>
      <div class="card-body">



      <?php if(session()->has('errors_model')) : ?>

        <ul>
          <?php foreach (session('errors_model') as $error):?>

              <li class="text-danger"><?= $error ;?></li>

            <?php endforeach; ?>
        </ul>

      <?php endif;?>

        
                   
        <?= form_open("admin/bairros/cadastrar")?>

            <?= $this->include('Admin/Bairros/form')?>

  
            <a href="<?= site_url("admin/bairros/")?>" class="btn btn-primary btn-sm  btn-icon-text  m-1">
  <i class="btn-icon-prepend mdi mdi-keyboard-backspace"></i> Voltar</a>




          <?= form_close();?>


    </div>
  </div>"
            

          </div>


<?= $this->endSection(); ?>



<?= $this->section('scripts'); ?>
<script src="<?= site_url('admin/vendors/mask/jquery.mask.min.js')?>"></script>
<script src="<?= site_url('admin/vendors/mask/app.js')?>"></script>


<script>

  $("#btn-salvar").prop('disabled', true);

  $('[name=cep]').focusout(function(){
    var cep = $(this).val();

    $.ajax({
      
      type : 'get',
      url: '<?= site_url('admin/bairros/consultacep')?>',
      dataType: 'json',
      data: {
        cep:cep
      },
      beforeSend: function(){
        $("#cep").html('Consultando...');
        $('[name=nome]').val('');
        $('[name=cidade]').val('');
        $('[name=estado]').val('');

        $("#btn-salvar").prop('disabled', true);


      },
      success: function(response){

        if(!response.erro){
          /**
           * sucesso
           */

        $('[name=nome]').val(response.endereco.bairro);
        $('[name=cidade]').val(response.endereco.localidade);
        $('[name=estado]').val(response.endereco.uf);
        $("#btn-salvar").prop('disabled', false);
        $("#cep").html('');


        
        }else{
          /**
           * tem erros de validacap, cep nao encontrado etc
           */
          $("#cep").html(response.erro);
        }

      }, //fim sucsess

      error: function(){
       
        $("#btn-salvar").prop('disabled', true);




      },

    });
  });

</script>

<?= $this->endSection(); ?>
