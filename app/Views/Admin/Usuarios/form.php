<div class="form-row">

<div class="form-group col-md-4 ">
<label for="nome">Nome</label>
<input type="text" class="form-control" name="nome" id="nome" placeholder="Nome" value="<?= $usuario->nome ?>">
</div>

<div class="form-group col-md-2">
    <label for="cpf">CPF</label>
    <input type="text" class="form-control cpf" name="cpf" id="cpf" placeholder="CPF" value="<?= $usuario->cpf ?>">
</div>

<div class="form-group col-md-3">
    <label for="telefone">Telefone</label>
    <input type="text" class="form-control sp_celphones" name="telefone" id="telefone" placeholder="Telefone"  value="<?= $usuario->telefone ?>">
</div>

<div class="form-group col-md-3">
    <label for="email">Email</label>
    <input type="text" class="form-control" name="email" id="email" placeholder="Email"  value="<?= $usuario->email ?>">
</div>

</div>


<div class="form-row">
    <div class="form-group col-md-3">
        <label for="password">Senha</label>
        <input type="password" class="form-control" name="password" id="password" placeholder="Senha" name="password">
    </div>
    <div class="form-group col-md-3">
        <label for="confirmation_password">Confirmação de Senha</label>
        <input type="password" class="form-control" name="confirmation_password" id="confirmation_password" placeholder="Confirmação de Senha">
    </div>
</div>

<!-- <div class="form-check form-check-flat form-check-primary">
<label class="form-check-label">
<input type="checkbox" class="form-check-input">
Remember me
</label>
</div> -->

<div class="mt-4">
  <a href="<?= site_url("admin/usuarios/show/$usuario->id")?>" class="btn-primary btn-sm btn-icon-text btn-icon-prepend mdi mdi-keyboard-backspace"> Voltar</a>
  <a href="<?= site_url("admin/usuarios/editar/$usuario->id")?>" class="btn-dark btn-sm btn-icon-text btn-icon-prepend mdi mdi-content-save"> Salvar</a>
  <a href="<?= site_url("admin/usuarios/editar/$usuario->id")?>" class="btn-danger btn-sm btn-icon-text btn-icon-prepend mdi mdi-delete-forever"> Excluir</a>
</div>

</div>