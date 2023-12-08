<?= $this->extend('Admin/layout/principal'); ?>


<?= $this->section('titulo'); ?>
<?= $titulo ?>
<?= $this->endSection(); ?>



<?= $this->section('estilos'); ?>
<?= $this->endSection(); ?>



<?= $this->section('conteudo'); ?>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
        <div class="card-body dashboard-tabs p-0">

            <div class="tab-content py-0 px-0">
            <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                <div class="d-flex flex-wrap justify-content-xl-between">
                    <div class="d-flex d-xl-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                        <i class="mdi mdi-currency-usd icon-lg mr-3 text-primary"></i>
                        <div class="d-flex flex-column justify-content-around">
                        <small class="mb-1 text-muted">Pedidos Entregues</small>
                        <h5 class="mr-2 mb-0">R$ 50,00</h5>
                        </div>
                    </div>
                    <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                        <i class="mdi mdi-currency-usd mr-3 icon-lg text-danger"></i>
                        <div class="d-flex flex-column justify-content-around">
                        <small class="mb-1 text-muted">Pedidos Cancelados</small>
                        <h5 class="mr-2 mb-0">R$ 10</h5>
                        </div>
                    </div>
                    <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                        <i class="mdi mdi-account-multiple mr-3 icon-lg text-success"></i>
                        <div class="d-flex flex-column justify-content-around">
                        <small class="mb-1 text-muted">Clientes Ativos</small>
                        <h5 class="mr-2 mb-0">200</h5>
                        </div>
                    </div>
                    <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                        <i class="mdi mdi-motorbike mr-3 icon-lg text-warning"></i>
                        <div class="d-flex flex-column justify-content-around">
                        <small class="mb-1 text-muted">Entregadores</small>
                        <h5 class="mr-2 mb-0">2233783</h5>
                        </div>
                    </div>

                </div>
            </div>
     

            </div>
        </div>
        </div>
    </div>
    </div>

<?= $this->endSection(); ?>



<?= $this->section('scripts'); ?>
<?= $this->endSection(); ?>
