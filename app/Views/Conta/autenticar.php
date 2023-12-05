<?= $this->extend('layout/principal_web'); ?>


<?= $this->section('titulo'); ?>
<?= $titulo ?>
<?= $this->endSection(); ?>



<?= $this->section('estilos'); ?>

<link rel="stylesheet" href="<?= site_url("web/src/assets/css/conta.css")?>">

<?= $this->endSection(); ?>





<div class="container section" id="menu" data-aos="fade-up" style="margin-top: 3em;min-height:300px">

<?= $this->section('conteudo'); ?>
    <?= $this->include("Conta/sidebar") ?>
    <div class="row">
    <h2 class="section-title"><?= esc($titulo)?></h2>    
        <div class="col-md-6 col-md-offset-3">
            <?php echo form_open('conta/processaautenticacao');?>

            <div class="panel panel-info">
                <div class="panel-body">
                

                    <div>
                        <label>Sua senha atual</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <hr>  

                </div>
                <div class="panel-footer">


                    <button type="submit" class="btn btn-primary" >Autenticar</button>


                  
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

     
     
     
   