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
    <label for="email">Perfil de Acesso</label>
    <select name="is_admin" id="" class="form-control">


<?php

if($usuario->id) :?>

    <option value="1" <?= set_select('is_admin', '1'); ?> <?= ($usuario->is_admin ? 'selected' : '') ?> >Admin</option>
    <option value="0" <?= set_select('is_admin', '2'); ?> <?= (!$usuario->is_admin ? 'selected' : '') ?> >Cliente</option>

<?php else: ?>

    <option value="1">Sim</option>
    <option value="0" selected>Não</option>

<?php endif;?>

    </select>
</div>


    <div class="form-group col-md-3">
    <label for="ativo">Ativo</label>
   <select name="ativo" id="" class="form-control">


<?php

if($usuario->id) :?>

    <option value="1" <?= set_select('ativo', '1'); ?> <?= ($usuario->ativo ? 'selected' : '') ?> >Sim</option>
    <option value="0" <?= set_select('ativo', '0'); ?> <?= (!$usuario->ativo ? 'selected' : '') ?>>Não</option>

<?php else: ?>


    <option value="1" <?= set_select('ativo', '1'); ?>>Sim</option>
    <option value="0" <?= set_select('ativo', '0'); ?> selected="" >Não</option>

    <?php endif;?>

   </select>
</div>



</div>



<div class="mt-4">
  <a href="<?= site_url("admin/usuarios/show/$usuario->id")?>" class="btn btn-primary btn-sm  btn-icon-text btn-icon-prepend mdi mdi-keyboard-backspace m-1"> Voltar</a>
  

<button type="submit" style="    height: 33px;padding-top: 4px;" class="btn btn-dark btn-icon-text btn-sm  m-1">
    <i class="mdi mdi-content-save btn-icon-prepend"></i>
    Salvar
</button>


  <a href="<?= site_url("admin/usuarios/editar/$usuario->id")?>" class="btn btn-sm btn-danger btn-icon-text btn-icon-prepend mdi mdi-delete-forever m-1"> Excluir</a>
</div>

</div>