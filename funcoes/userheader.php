<header>
  <!-- Modal -->
  <div class="modal fade" id="insertuser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h6 class="modal-title text-white" id="exampleModalLabel">Adicionar Usuários</h6>
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
                  <option value="0">Administrativo</option>
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

  <!-- Update Modal -->
  <div class="modal fade" id="editmodaluser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h6 class="modal-title text-white" id="exampleModalLabel">Alterar Usuário</h6>
        </div>
        <form action="updateuser.php" method="POST">
          <div class="modal-body">
            <div class="form-group row">
              <label for="id" class="col-sm-3 col-form-label">Id Usuário</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="uiduser" name="uiduser" readonly>
              </div>
            </div>
            <div class="form-group row">
              <label for="nome" class="col-sm-3 col-form-label">Nome</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="unome" name="unome" placeholder="Nome">
              </div>
            </div>
            <div class="form-group row">
              <label for="email" class="col-sm-3 col-form-label">E-mail</label>
              <div class="col-sm-9">
                <input type="email" class="form-control" id="uemail" name="uemail" placeholder="Email">
              </div>
            </div>
            <div class="form-group row">
              <label for="login" class="col-sm-3 col-form-label">Login</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="ulogin" name="ulogin" readonly>
              </div>
            </div>
            <div class="form-group row">
              <label for="senha" class="col-sm-3 col-form-label">Senha</label>
              <div class="col-sm-9">
                <input type="password" class="form-control" id="usenha" name="usenha" placeholder="Senha Inicial" readonly>
              </div>
            </div>
            <div class="form-group row">
              <label for="lastdate" class="col-sm-3 col-form-label">Último Login</label>
              <div class="col-sm-4">              
              <input type="text" class="form-control" id="udata" name="udata" readonly>
              </div>
              <div class="col-sm-4">              
              <input type="text" class="form-control" id="uhora" name="uhora" readonly>
              </div>
            </div>           
            <div class="form-group row">
              <label class="col-form-label col-sm-4 pt-0">Nível de Acesso</label>
              <div class="col-sm-8">
                <select name="univel" id="univel">
                  <option selected value="">Escolha</option>
                  <option value="0">Administrativo</option>
                  <option value="1">Comum</option>
                </select>
              </div>
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            <input type="submit" name="updateuser" class="btn btn-success" value="Salvar"></input>
            <!--<button type="submit" name="insertuser" class="btn btn-success">Salvar</button> -->
          </div>
        </form>
      </div>
    </div>
  </div>

  <!--NAV BAR -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
    <a class="navbar-brand" href="#"><img src="./img/start.png" width="40" height="40"></a>
    <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="#">Produtos</a>
        </li>
        <li class="nav-item ">
          <a class="nav-link" href="#">Categorias</a>
        </li>
        <li class="nav-item dropdown active">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Usuários
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a type="button" class="nav-link text-light bg-primary" data-toggle="modal" data-target="#insertuser">Adicionar Usuário</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Algo mais aqui</a>
          </div>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="index.php">Voltar</a>
        </li>
      </ul>
      <form class="form-inline my-2 my-lg-0" action="pesquisa.php" method="post" name="form_pesquisa" id="form_pesquisa">
        <input class="form-control mr-sm-2" type='text' id="pesquisaCliente" name="pesquisaCliente" Placeholder="Procurar Nome Usuário">
        <i class='fas fa-search' style='font-size: 28px; color: white;'></i>
      </form>
    </div>
  </nav>
</header>