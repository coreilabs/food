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

            <?php if(session()->has('errors_model')) : ?>

            <ul style="list-style:decimal">
            <?php foreach (session('errors_model') as $error):?>

            <li class="text-danger"><?= $error ;?></li>

            <?php endforeach; ?>
            </ul>

            <?php endif;?>
            
            <?php echo form_open('conta/atualizarsenha');?>

            <div class="panel panel-info">
                <div class="panel-body">
                

                    <div>
                        <label>Senha Atual</label>
                        <input type="password" name="current_password" class="form-control">
                    </div>
                    <hr>

                    <div>
                        <label>Nova Atual</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <hr>

                    <div>
                        <label>Confirme a Nova Senha</label>
                        <input type="password" name="password_confirmation" class="form-control">
                    </div>
                    <hr>









                

                </div>
                <div class="panel-footer">


                    <button type="submit" class="btn btn-primary" >Atualizar</button>


                  
                    <a href="<?= site_url('conta/show')?>" class="btn btn-default">Cancelar</a>

                </div>
            </div>

            <?php echo form_close();?>
            
        </div>
    </div>

</div>

<?= $this->endSection(); ?>



<?= $this->section('scripts'); ?>



<script src="<?= site_url('admin/vendors/mask/jquery.mask.min.js')?>"></script>
<script src="<?= site_url('admin/vendors/mask/app.js')?>"></script>





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

     
     
     
   