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
          <div class="product-content product-wrap clearfix product-deatil center-block" style="max-width:40%">
              <div class="row">

                <div class="col-md-12">

                <h4>Criar Conta</h4>

                <?php if(session()->has('errors_model')): ?>

                    <ul style="margin-left:-1.6em !important;">
                        <?php foreach(session('errors_model') as $error) : ?>

                        <li class="text-danger"><?php echo $error ?></li>

                        <?php endforeach; ?>
                    </ul>


                    <?php endif; ?>

                <?= form_open("registrar/criar")?>

                    <div class="form-group">
                        <label>Nome Completo</label>
                        <input type="text" class="form-control"placeholder="Nome Completo" name="nome" value="<?= old('nome')?>">
                    </div> 

                    <div class="form-group">
                        <label >Email Válido</label>
                        <input type="email" class="form-control"  name="email" placeholder="Digite seu Email" value="<?= old('nome')?>">
                        <small id="emailHelp" class="form-text text-muted">Não divulgamos seu email.</small>

                    </div>
                    <div class="form-group">
                        <label >CPF Válido</label>
                        <input type="text" class="form-control cpf"  name="cpf" placeholder="Digite seu CPF" value="<?= old('cpf')?>">

  
                    </div>
                    <div class="form-group">
                        <label >Sua Senha</label>
                        <input type="password" class="form-control" name="password"  placeholder="Sua Senha">
                    </div>
                    <div class="form-group">
                        <label >Confirme Sua Senha</label>
                        <input type="password" class="form-control" name="password_confirmation" placeholder="Confirme Sua Senha">
                    </div>
                    <button type="submit" class="btn btn-block btn-food" style="margin-top:3em;">Criar Minha Conta</button>
                    
                    <?= form_close();?>

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

     
     
     
   