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
                <div class="card-body">

                  <h2 class="card-title"><?= esc($titulo) ?></h2>
                  <hr>

             
                  <p class="card-text"><?= esc($usuario->nome)?></p>
                

              

                </div>
              </div>
            </div>
            

          </div>


<?= $this->endSection(); ?>



<?= $this->section('scripts'); ?>

<?= $this->endSection(); ?>
