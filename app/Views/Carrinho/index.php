<?= $this->extend('layout/principal_web'); ?>


<?= $this->section('titulo'); ?>
<?= $titulo ?>
<?= $this->endSection(); ?>



<?= $this->section('estilos'); ?>

<link rel="stylesheet" href="<?= site_url("web/src/assets/css/produto.css")?>">

<?= $this->endSection(); ?>



<?= $this->section('conteudo'); ?>

<div class="container-fluid section" id="menu" data-aos="fade-up" style="margin-top: 3em">
      <div class="col-sm-12 col-md-12 col-lg-12">
          <!-- product -->
          <div class="product-content product-wrap clearfix product-deatil">
              <div class="row">

              <?php if(!isset($carrinho)):?>

                <div class="text-center">
                    <h2 class="text-center">Seu carrinho de compras está vazio.</h2>
                    <a href="<?php echo site_url("/"); ?>" class="btn btn-lg " style="background-color: #990100;color:white; margin-top:2em;">Ver produtos</a>
                </div>

                

                <?php else:?>

                <div class="table-responsive">
                    <table class="table table-hover">
            
                        <thead>
                            <tr>
                            <th class="text-center" scope="col">Remover</th>
                            <th scope="col">Produto</th>
                            <th scope="col">Tamanho</th>
                            <th  class="text-center" scope="col">Quantidade</th>
                            <th scope="col">Preço</th>
                            <th scope="col">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php $total = 0; ?>

                            <?php foreach($carrinho as $produto):?>

                            <tr>
                            <th class="text-center" scope="row">
                                <a class="btn btn-danger btn-sm" href="<?= site_url("carrinho/remover/$produto->slug")?>"> X </a>
                            </th>
                            <td ><?= esc($produto->nome)?></td>
                            <td><?= esc($produto->tamanho)?></td>
                            <td class="text-center">
                                <?= form_open("carrinho/atualizar", ['class' => 'form-inline'])?>
                                <div class="form-group">
                                <input type="number" class="form-control" name="produto[quantidade]" value="<?= esc($produto->quantidade)?>" min="1" max="10" step="1" required="">
                                <input type="hidden" name="produto[slug]" value="<?= esc($produto->slug)?>">
                                </div>

                                <button type="submit" class="btn btn-primary float-right">
                                    Atualizar
                                </button>
                                <?= form_close();?>
                            </td>
                            <td>R$ <?= esc($produto->preco)?></td>

                            <?php 
                                    $subTotal = $produto->preco * $produto->quantidade;
                                    $total += $subTotal
                                ?>

                            <td>R$ <?= number_format($subTotal, 2)?></td>
                            </tr>

                            <?php endforeach;?>
                            
                        </tbody>
                        </table>
                    </table>
              </div>

              <?php endif;?>

          </div>
      </div>
      <!-- end product -->
  </div>

<?= $this->endSection(); ?>



<?= $this->section('scripts'); ?>

<script>
   
</script>
<?= $this->endSection(); ?>

     
     
     
   