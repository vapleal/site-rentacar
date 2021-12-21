<form action="funcoes/cadusuario.php" method="post" id="registro">
    <div class="modal fade" id="RegisterModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title" id="exampleModalLabel"> Cadastro </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <!-- Dados Pessoais -->
                <div class="form-group">
                    <label for="cpf">CPF (somente números):</label>
                    <input type="text" class="form-control" id="cpf" name="cpf" placeholder="Seu CPF...">
                </div>
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Seu Nome...">
                </div>
                <div class="form-group">
                    <label for="cnh">CNH</label>
                    <input type="text" class="form-control" id="cnh" name="cnh" placeholder="Sua CNH...">
                </div>
            <!-- Fim -->
            <!-- Dados Endereço -->
                <div class="form-group">
                    <label for="cep">CEP (somente números):</label>
                    <input type="text" class="form-control" id="cep" name="cep" placeholder="CEP somente números...">
                </div>
                <div class="form-group">
                    <label for="nome">Endere</label>
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Seu Nome...">
                </div>
                <div class="form-group">
                    <label for="nome">CNH</label>
                    <input type="text" class="form-control" id="cnh" name="cnh" placeholder="Sua CNH...">
                </div>
                <div class="form-group">
                    <label for="email">E-mail:</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Seu e-mail...">
                </div>
                <div class="form-group">
                    <label for="senhac">Senha:</label>
                    <input type="password" class="form-control" id="senhac" name="senhac" placeholder="Sua senha...">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"> Fechar </button>
                <button type="button" id="enviar" class="btn btn-primary"> Cadastrar </button>               
            </div>
            </div>
        </div>
    </div>
</form>