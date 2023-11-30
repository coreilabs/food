<?= $this->extend('layout/principal_web'); ?>


<?= $this->section('titulo'); ?>
<?= $titulo ?>
<?= $this->endSection(); ?>



<?= $this->section('estilos'); ?>

<link rel="stylesheet" href="<?= site_url("web/src/assets/css/conta.css")?>">

<?= $this->endSection(); ?>



<?= $this->section('conteudo'); ?>

<div class="container-fluid section" id="menu" data-aos="fade-up" style="margin-top: 3em">


    <?= $this->include("Conta/sidebar") ?>
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
  
        
        </div>
    </div>

</div>

<?= $this->endSection(); ?>



<?= $this->section('scripts'); ?>

<script>

                    /* Set the width of the sidebar to 250px and the left margin of the page content to 250px */
                    function openNav() {
        document.getElementById("mySidebar").style.width = "250px";
        document.getElementById("main").style.marginLeft = "250px";
        }

        /* Set the width of the sidebar to 0 and the left margin of the page content to 0 */
        function closeNav() {
        document.getElementById("mySidebar").style.width = "0";
        document.getElementById("main").style.marginLeft = "0";
        }


    $(document).ready(function(){


      
    });
</script>
<?= $this->endSection(); ?>

     
     
     
   