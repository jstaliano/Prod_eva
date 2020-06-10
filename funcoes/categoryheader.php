<header>
    <!-- Modal -->
    <div class="modal fade" id="insertcategoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h6 class="modal-title text-white" id="exampleModalLabel">Adicionar Categoria</h6>
                    <!--<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button> -->
                </div>
                <form action="insertcategory.php" method="POST">
                    <div class="modal-body">

                        <div class="form-group row">
                            <label for="nome" class="col-sm-3 col-form-label">Nome</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="idcat" name="idcat" readonly>                                
                                <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="descricao" class="col-sm-3 col-form-label">Descrição</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Descrição">
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

     <!-- UPdate Modal -->
     <div class="modal fade" id="editmodalcat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h6 class="modal-title text-white" id="exampleModalLabel">Alterar Categoria</h6>                    
                </div>
                <form action="updatecategory.php" method="POST">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="id" class="col-sm-3 col-form-label">Id Categoria</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="uidcat" name="uidcat" readonly>                                
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nome" class="col-sm-3 col-form-label">Nome</label>
                            <div class="col-sm-9">                               
                                <input type="text" class="form-control" id="unomecat" name="unomecat" placeholder="Nome">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="descricao" class="col-sm-3 col-form-label">Descrição</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="udescricaocat" name="udescricaocat" placeholder="Descrição">
                            </div>
                        </div>                        
                        <div class="form-group row">
                            <label for="data" class="col-sm-3 col-form-label">Criado Em</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="udatacat" name="udatacat" readonly>
                            </div>
                        </div>                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <input type="submit" name="updatecategory" class="btn btn-success" value="Salvar"></input>
                        <!--<button type="submit" name="updatecategory" class="btn btn-success">Salvar</button> -->
                    </div>
                </form>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
        <a class="navbar-brand" href="#"><img src="./img/start.png" width="40" height="40"></a>
        <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Produtos</a>
                </li>
                <li class="nav-item dropdown active">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Categorias
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a type="button" class="nav-link text-light bg-primary" data-toggle="modal" data-target="#insertcategoria">Adicionar Categoria</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Algo mais aqui</a>
                    </div>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="#">Usuários</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Voltar</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0" action="pesquisa.php" method="post" name="form_pesquisa" id="form_pesquisa">
                <input class="form-control mr-sm-3" type='text' id="pesquisaCliente" name="pesquisaCliente" Placeholder="Nome da Categoria">
                <i class='fas fa-search' style='font-size: 28px; color: white;'></i>
            </form>
        </div>
    </nav>
</header>