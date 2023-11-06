<div class="form-row">

    <div class="form-group col-md-6 ">
        <label for="nome">Nome</label>
        <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome" value="<?= old('nome', esc($categoria->nome)) ?>">
    </div>

  
</div>

<div class="form-row">
<div class="form-group col-md-3">
    <div class="form-check form-check-flat form-check-primary">
        <label for="ativo" class="form-check-label">

            <input type="hidden" value="0" name="ativo">

            <input type="checkbox" class="form-check-input" id="ativo" name="ativo" value="1" <?php if(old('ativo', $categoria->ativo)) : ?> checked="" <?php endif; ?> >
            Ativo
        </label>

    </div>

</div>


</div>



  

<button type="submit"  class="btn btn-dark btn-icon-text btn-sm  m-1">
    <i class="mdi mdi-content-save btn-icon-prepend"></i>
    Salvar
</button>