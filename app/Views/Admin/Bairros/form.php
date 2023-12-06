<div class="form-row">



<?php if(!$bairro->id):?>
    <div class="form-group col-md-12 ">
        <label for="cep">CEP</label>
        <input type="text" class="form-control cep" name="cep" placeholder="CEP" value="<?= old('cep', esc($bairro->cep)) ?>">
        <div id="cep"></div>
    </div>
    <?php endif;?>

    <div class="form-group col-md-12 ">
        <label for="nome">Nome</label>
        <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome" value="<?= old('nome', esc($bairro->nome)) ?>" readonly="">
    </div>


    <div class="form-group col-md-12 ">
        <label for="cidade">Cidade</label>
        <input type="text" class="form-control" name="cidade" id="cidade" placeholder="Cidade" value="<?= old('cidade', esc($bairro->cidade)) ?>" readonly="">
    </div>
    <?php if(!$bairro->id):?>
        <div class="form-group col-md-12 ">
        <label for="estado">Estado</label>
        <input type="text" class="form-control uf" name="estado" id="estado" placeholder="Estado" readonly="">
    </div>
    <?php endif;?>


    <div class="form-group col-md-6 ">
        <label for="valor_entrega">Valor de Entrega (R$)</label>
        <input type="text" class="form-control money" name="valor_entrega" id="valor_entrega" placeholder="Preço" value="<?= old('valor_entrega', esc(number_format($bairro->valor_entrega,2,',', '.'))) ?>">
    </div>

  
</div>

<div class="form-row">
<div class="form-group col-md-3">
    <div class="form-check form-check-flat form-check-primary">
        <label for="ativo" class="form-check-label">

            <input type="hidden" value="0" name="ativo">

            <input type="checkbox" class="form-check-input" id="ativo" name="ativo" value="1" <?php if(old('ativo', $bairro->ativo)) : ?> checked="" <?php endif; ?> >
            Ativo
        </label>

    </div>

</div>


</div>



  

<button type="submit"  id="btn-salvar" class="btn btn-dark btn-icon-text btn-sm  m-1">
    <i class="mdi mdi-content-save btn-icon-prepend"></i>
    Salvar
</button>