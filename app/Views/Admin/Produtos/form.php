<div class="form-row">

    <div class="form-group col-md-12 ">
        <label for="nome">Nome</label>
        <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome" value="<?= old('nome', esc($produto->nome)) ?>">
    </div>


    <div class="form-group col-md-4 ">
       <select name="categoria_id" class="custom-select" id="">

       <option value="">Escolha a categoria...</option>

        <?php  foreach ($categorias as $categoria):        ?>

            <?php if($produto->id):?>

                <option value="<?= $categoria->id?>" <?php echo ($categoria->id == $produto->categoria_id ? 'selected=""' : ''); ?> ><?= esc($categoria->nome) ?></option>

            <?php else: ?>

                <option value="<?= $categoria->id?>" ><?= esc($categoria->nome) ?></option>


            <?php endif;?>

        <?php endforeach;?>


       </select>
    
    </div>

    <div class="form-group col-md-12 ">
        <label for="ingredientes">Ingredientes</label>
        <textarea name="ingredientes" class="form-control" id="" cols="30" rows="3" id="ingredientes"><?= old('ingredientes', esc($produto->ingredientes)) ?></textarea>
       
    </div>

  
</div>

<div class="form-row">
<div class="form-group col-md-3">
    <div class="form-check form-check-flat form-check-primary">
        <label for="ativo" class="form-check-label">

            <input type="hidden" value="0" name="ativo">

            <input type="checkbox" class="form-check-input" id="ativo" name="ativo" value="1" <?php if(old('ativo', $produto->ativo)) : ?> checked="" <?php endif; ?> >
            Ativo
        </label>

    </div>

</div>


</div>



  

<button type="submit"  class="btn btn-dark btn-icon-text btn-sm  m-1">
    <i class="mdi mdi-content-save btn-icon-prepend"></i>
    Salvar
</button>