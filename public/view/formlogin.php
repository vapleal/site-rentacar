<form action="" method="post" id="entrar">
    <div class="modal fade" id="LoginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title" id="exampleModalLabel"> Login </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="login" class="col-form-label">Login: </label>
                    <input type="text" class="form-control" id="login" name="login">
                </div>
                <div class="form-group">
                    <label for="senha" class="col-form-label">Senha: </label>
                    <input type="password" class="form-control" id="senha" name="senha">
                </div>
            </div>
            <div class="modal-footer">
                <p>Não tem cadastro? <a href="#" data-dismiss="modal" data-toggle="modal" data-target="#RegisterModal"> Clique aqui! </a></p>
                <button type="button" class="btn btn-secondary" data-dismiss="modal"> Fechar </button>
                <button type="button" id="start" class="btn btn-primary"> Start </button>               
            </div>
            </div>
        </div>
    </div>
</form>
