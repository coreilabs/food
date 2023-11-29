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
          <div class="product-content product-wrap clearfix product-deatil center-block" style="max-width:60%">
              <div class="row">

                <div class="col-md-12">

                    

                    <div class="alert alert-success" role="alert" style="margin-top:2em">
                        <h4 class="alert-heading">Perfeito</h4>
                        <p><?= $titulo?>.</p>
                        <hr>
                        <p class="mb-0">Verifique seu email para ativar a sua conta.</p>
                        </div>
          

                </div>

          </div>
      </div>
      <!-- end product -->
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

     
     
     
   