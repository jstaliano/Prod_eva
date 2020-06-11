<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Modal</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

</head>

<body>

    <!-- Modal -->
    <div class="modal fade" id="insertuser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Adicionar Usuários</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="insertuser.php" method="POST">
                    <div class="modal-body">

                        <div class="form-group row">
                            <label for="nome" class="col-sm-3 col-form-label">Nome</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-3 col-form-label">E-mail</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="login" class="col-sm-3 col-form-label">Login</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="login" name="login" placeholder="Login">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="senha" class="col-sm-3 col-form-label">Senha</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha Inicial">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-sm-4 pt-0">Nível de Acesso</label>
                            <div class="col-sm-8">
                                <select name="nivel" id="nivel">
                                    <option selected value="">Escolha</option>
                                    <option value="1">Administrativo</option>
                                    <option value="1">Comum</option>
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="submit" name="insertuser" class="btn btn-success">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- principal -->
    <div class="container">
        <div class="jumbotron">
            <div class="card">
                <h2>PHP Pop Up Modal</h2>
            </div>
            <div class="card">
                <div class="card-body">
                    <button type="button" class="btn btn-primary text-white" data-toggle="modal" data-target="#insertuser">
                        ADICIONAR REGISTRO
                    </button>
                </div>
            </div>
        </div>

    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>

</html>