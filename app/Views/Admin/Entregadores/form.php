<div class="form-row">

    <div class="form-group col-md-4 ">
        <label for="nome">Nome</label>
        <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome" value="<?= old('nome', esc($entregador->nome)) ?>">
    </div>

    <div class="form-group col-md-2">
        <label for="cpf">CPF</label>
        <input type="text" class="form-control cpf" name="cpf" id="cpf" placeholder="CPF" value="<?= old('cpf',esc($entregador->cpf) )?>">
    </div>

    <div class="form-group col-md-3">
        <label for="cnh">CNH</label>
        <input type="text" class="form-control cnh" name="cnh" id="cnh" placeholder="CNH" value="<?= old('cnh',esc($entregador->cnh) )?>">
    </div>

    <div class="form-group col-md-3">
        <label for="telefone">Telefone</label>
        <input type="text" class="form-control sp_celphones" name="telefone" id="telefone" placeholder="Telefone"  value="<?= old('telefone', esc($entregador->telefone) )?>">
    </div>

    <div class="form-group col-md-2">
        <label for="email">Email</label>
        <input type="text" class="form-control" name="email" id="email" placeholder="Email"  value="<?= old('email', esc($entregador->email) )?>">
    </div>

    <div class="form-group col-md-3">
        <label for="veiculo">Veículo</label>
        <input type="text" class="form-control " name="veiculo" id="veiculo" placeholder="Veículo"  value="<?= old('veiculo', esc($entregador->veiculo) )?>">
    </div>

    <div class="form-group col-md-2">
        <label for="placa">Placa</label>
        <input type="text" class="form-control placa " name="placa" id="placa" placeholder="Placa"  value="<?= old('placa', esc($entregador->placa) )?>">
    </div>

    <div class="form-group col-md-5">
        <label for="endereco">Endereço</label>
        <input type="text" class="form-control " name="endereco" id="endereco" placeholder="Endereço"  value="<?= old('endereco', esc($entregador->endereco) )?>">
    </div>

</div>



<div class="form-row">






<div class="form-group col-md-3">



    <div class="form-check form-check-flat form-check-primary">

        <label for="ativo" class="form-check-label">

            <input type="hidden" value="0" name="ativo">

            <input type="checkbox" class="form-check-input" id="ativo" name="ativo" value="1" <?php if(old('ativo', $entregador->ativo)) : ?> checked="" <?php endif; ?> >
            Ativo
        </label>

    </div>

</div>





</div>




  

<button type="submit"  class="btn btn-dark btn-icon-text btn-sm  m-1">
    <i class="mdi mdi-content-save btn-icon-prepend"></i>
    Salvar
</button>




