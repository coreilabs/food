<div class="form-row">

    <div class="form-group col-md-4 ">
        <label for="nome">Nome</label>
        <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome" value="<?= old('nome', esc($usuario->nome)) ?>">
    </div>

    <div class="form-group col-md-2">
        <label for="cpf">CPF</label>
        <input type="text" class="form-control cpf" name="cpf" id="cpf" placeholder="CPF" value="<?= old('cpf',esc($usuario->cpf) )?>">
    </div>

    <div class="form-group col-md-3">
        <label for="telefone">Telefone</label>
        <input type="text" class="form-control sp_celphones" name="telefone" id="telefone" placeholder="Telefone"  value="<?= old('telefone', esc($usuario->telefone) )?>">
    </div>

    <div class="form-group col-md-3">
        <label for="email">Email</label>
        <input type="text" class="form-control" name="email" id="email" placeholder="Email"  value="<?= old('email', esc($usuario->email) )?>">
    </div>

</div>


<div class="form-row">
    <div class="form-group col-md-3">
        <label for="password">Senha</label>
        <input type="password" class="form-control" name="password" id="password" placeholder="Senha" name="password">
    </div>
    <div class="form-group col-md-3">
        <label for="password_confirmation">Confirmação de Senha</label>
        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Confirmação de Senha">
    </div>





    <div class="form-group col-md-3">

</div>



</div>


<div class="form-row">

<div class="form-group col-md-3">



<div class="form-check form-check-flat form-check-primary">
             
<label for="is_admin" class="form-check-label">

<input type="hidden" value="0" name="is_admin">

<input type="checkbox" class="form-check-input" id="is_admin" name="is_admin" value="1" <?php if(old('is_admin', $usuario->is_admin)) : ?> checked="" <?php endif; ?> >
Administrador
</label>

                </div>

</div>




<div class="form-group col-md-3">



    <div class="form-check form-check-flat form-check-primary">

        <label for="ativo" class="form-check-label">

            <input type="hidden" value="0" name="ativo">

            <input type="checkbox" class="form-check-input" id="ativo" name="ativo" value="1" <?php if(old('ativo', $usuario->ativo)) : ?> checked="" <?php endif; ?> >
            Ativo
        </label>

    </div>

</div>





</div>


<div class="mt-4">

  

<button type="submit"  class="btn btn-dark btn-icon-text btn-sm  m-1">
    <i class="mdi mdi-content-save btn-icon-prepend"></i>
    Salvar
</button>



</div>

</div>