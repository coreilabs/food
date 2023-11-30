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
        <div class="col-xs-12 col-md-12 col-lg-12">
                
        </div>
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-info">
                <div class="panel-body">
                
                    <dl>

                        <dt>Nome Completo</dt>
                        <dd><?= esc($usuario->nome)?></dd>
                        <hr>

                        <dt>Email de Acesso</dt>
                        <dd><?= esc($usuario->email)?></dd>
                        <hr>

                        <dt>Telefone</dt>
                        <dd><?= esc($usuario->telefone)?></dd>
                        <hr>

                        <dt>CPF</dt>
                        <dd><?= esc($usuario->cpf)?></dd>
                        <hr>

                        <dt>Cliente Desde</dt>
                        <dd><?= $usuario->criado_em->humanize()?></dd>

                    </dl>
                

                </div>
                <div class="panel-footer">


                    <a href="<?= site_url('conta/editar')?>" class="btn btn-primary">Editar</a>
                    <a href="<?= site_url('conta/editar')?>" class="btn btn-danger">Alterar Senha</a>

                </div>
            </div>
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

     
     
     
   