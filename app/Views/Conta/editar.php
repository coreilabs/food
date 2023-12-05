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
            
            <?php echo form_open('conta/atualizar');?>

            <div class="panel panel-info">
                <div class="panel-body">
                

                    <div>
                        <label>Nome Completo</label>
                        <input type="text" name="nome" class="form-control" value="<?= old('nome', esc($usuario->nome))?>">
                    </div>
                    <hr>
                    <div>
                        <label>Email de Acesso</label>
                        <input type="email" name="email" class="form-control" value="<?= old('email', esc($usuario->email))?>">
                    </div>
                    <hr>
                    <div>
                        <label>Telefone de Contato</label>
                        <input type="tel" name="telefone" class="form-control sp_celphones" value="<?= old('telefone', esc($usuario->telefone))?>">
                    </div>
                    <hr>
                    <div>
                        <label>CPF <i class="fa fa-lock text-warning"></i></label>
                        <div class="well well-sm"><?= esc($usuario->cpf)?></div>
                    </div>








                

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

     
     
     
   