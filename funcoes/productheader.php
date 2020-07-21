<?php
//require 'conexao.php';
$conexao = conexao::getInstance();
$sql = "SELECT CategoryId, CategoryName FROM categories ORDER BY CategoryName ASC";
$stm = $conexao->prepare($sql);
$stm->execute();
$categories = $stm->fetchAll(PDO::FETCH_OBJ);

?>

<header>
  <!-- Insert Modal -->
  <div class="modal fade" id="insertproduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h6 class="modal-title text-white" id="exampleModalLabel">Adicionar Produto</h6>
        </div>
        <form action="updateproduct.php" method="POST" enctype='multipart/form-data'>
          <?php
          $code = 0;
          do {
            $code++;
            $sql = "SELECT ProductId, ProductCode FROM products WHERE ProductCode=$code ORDER BY ProductCode ASC";
            $stm = $conexao->prepare($sql);
            $stm->execute();
            $products = $stm->fetchAll(PDO::FETCH_OBJ);
          } while ($products);
          $novocodigo = $code;
          ?>
          <div class="modal-body">
            <div class="form-group row">
              <label for="codigo" class="col-sm-3 col-form-label">Código</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="codigo" name="codigo" placeholder="Código" value=<?php echo str_pad($novocodigo, 8, "0", STR_PAD_LEFT); ?>>
              </div>
            </div>
            <div class="form-group row">
              <label for="NCM" class="col-sm-3 col-form-label">NCM</label>
              <div class="col-sm-5">
                <input type="number" class="form-control" id="ncm" name="ncm" placeholder="NCM">
              </div>
            </div>
            <div class="form-group row">
              <label for="preço" class="col-sm-3 col-form-label">Preço</label>
              <div class="col-sm-5">
                <div class="input-group-prepend">
                  <div class="input-group-text">R$</div>                  
                <input type="number" class="form-control" id="price" name="price" min="0" step="0.01" placeholder="Preço">                
                </div>
              </div>
            </div>
            <div class="form-group row">
              <label for="fornecedor" class="col-sm-3 col-form-label">Fornecedor</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="supplier" name="supplier" placeholder="Fornecedor">
              </div>
            </div>
            <div class="form-group row">
              <label for="nome" class="col-sm-3 col-form-label">Descrição do Produto</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Descrição" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="categoria" class="col-sm-3 col-form-label">Categoria</label>
              <div class="col-sm-9">
                <select type="text" class="form-control" id="categoria" name="categoria" placeholder="Categoria" required>
                  <option value='' SELECTED>Escolha a Categoria</option>
                  <?php foreach ($categories as $category) {
                    echo '<option value="' . $category->CategoryId . '">' . $category->CategoryName . '</option>';
                  }  ?>

                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="img" class="col-sm-3 col-form-label">Foto</label>
              <div class="col-sm-9">
                <input type="file" id="img" name="img" placeholder="Imagem do Produto" required>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            <input type="submit" id="salvainclusao" name="insertproduct" class="btn btn-success" value="Salvar"></input>

          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- UPDATE MODAL  -->
  <!-- Modal -->
  <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header bg-warning">
          <h6 class="modal-title text-white" id="exampleModalLabel">Alterar Produto</h6>
        </div>
        <form action="updateproduct.php" method="POST" enctype='multipart/form-data'>
          <div class="modal-body">
            <div class="form-group row">
              <label for="codigo" class="col-sm-3 col-form-label">Código</label>
              <div class="col-sm-9">
                <input type="hidden" class="form-control" id="uidcodigo" name="uidcodigo">
                <?php if ($_SESSION['nivel'] == 0) : ?>
                  <input type="text" class="form-control" id="ucodigo" name="ucodigo" placeholder="Código">
                <?php else : ?>
                  <input type="text" class="form-control" id="ucodigo" name="ucodigo" placeholder="Código" readonly>
                <?php endif; ?>
              </div>
            </div>
            <div class="form-group row">
              <label for="NCM" class="col-sm-3 col-form-label">NCM</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="uncm" name="uncm" placeholder="NCM">
              </div>
            </div>
            <div class="form-group row">
              <label for="preço" class="col-sm-3 col-form-label">Preço</label>
              <div class="col-sm-5">
                <div class="input-group-prepend">
                  <div class="input-group-text">R$</div>                  
                <input type="text" class="form-control" id="uprice" name="uprice" placeholder="Preço">                
                </div>
              </div>
            </div>
            <div class="form-group row">
              <label for="fornecedor" class="col-sm-3 col-form-label">Fornecedor</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="usupplier" name="usupplier" placeholder="Fornecedor">
              </div>
            </div>
            <div class="form-group row">
              <label for="nome" class="col-sm-3 col-form-label">Nome</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="unome" name="unome" placeholder="Nome" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="categoria" class="col-sm-3 col-form-label">Categoria</label>
              <div class="col-sm-9">
                <select type="text" class="form-control" id="ucategoria" name="ucategoria" placeholder="Categoria" required>
                  <?php foreach ($categories as $category) {
                    echo '<option value="' . $category->CategoryId . '">' . $category->CategoryName . '</option>';
                  }  ?>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="img" class="col-sm-3 col-form-label">Foto</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="ufoto" name="ufoto" placeholder="Imagem do Produto" required><br \>
                <img src="" id="my_image" width="180"> <br \>
                <hr class="btn-warning" style="height:5px;">
                <input type="File" id="uimg" name="uimg" placeholder="Imagem do Produto">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            <input type="submit" id="updateproduct" name="updateproduct" class="btn btn-success" value="Salvar"></input>
            <!--<button type="button" name="updateproduct" class="btn btn-success editbtn" >Salvar</button> -->
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- END UPDATE FORM MODAL -->
  <!-- DELETE MODAL  -->
  <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-danger">
          <h6 class="modal-title text-white" id="exampleModalLabel">Apagar Produto</h6>
        </div>
        <form action="updateproduct.php" method="POST" enctype='multipart/form-data'>
          <div class="modal-body">
            <div class="form-group row">
              <label for="codigo" class="col-sm-3 col-form-label">Código</label>
              <div class="col-sm-9">
                <input type="hidden" class="form-control" id="didcodigo" name="didcodigo">
                <input type="text" class="form-control" id="dcodigo" name="dcodigo" placeholder="Código" readonly>
              </div>
            </div>
            <div class="form-group row">
              <label for="nome" class="col-sm-3 col-form-label">Nome</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="dnome" name="dnome" readonly>
              </div>
            </div>
            <div class="form-group row">
              <label for="img" class="col-sm-3 col-form-label">Foto</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="dfoto" name="dfoto" readonly><br \>
                <img src="" id="dmy_image" width="180"> <br \>
                <hr class="btn-danger" style="height:5px;">
                <!--<input type="File" id="dimg" name="dimg" placeholder="Imagem do Produto">-->
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Voltar</button>
            <input type="submit" name="deleteproduct" class="btn btn-success" value="Confirmar!"></input>
            <!--<button type="button" name="updateproduct" class="btn btn-success editbtn" >Salvar</button> -->
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- END DELETE FORM MODAL -->
  <!--NAV-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
    <a class="navbar-brand" href="#"><img src="./img/start.png" width="30" height="30"></a>
    <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item dropdown active">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Produtos
          </a>
          <div class="dropdown-menu bg-primary" aria-labelledby="navbarDropdown">
            <a type="button" class="nav-link text-light" data-toggle="modal" data-target="#insertproduct">Adicionar Produto</a>
            <div class="dropdown-divider"></div>
            <!--<a class="dropdown-item" href="#">Algo mais aqui</a> -->
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Categorias</a>
        </li>
        <li class="nav-item ">
          <a class="nav-link" href="#">Usuários</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="index.php">Voltar</a>
        </li>
      </ul>
      <form class="form-inline my-2 my-lg-0" action="pesquisa.php" method="post" name="form_pesquisa" id="form_pesquisa">
        <input class="form-control mr-sm-2" type='text' id="pesquisaCliente" name="pesquisaCliente" Placeholder="Descrição do Produto">
        <i class='fas fa-search' style='font-size: 28px; color: white;'></i>
      </form>
    </div>
  </nav>
  <div class="alert"></div>
</header>


