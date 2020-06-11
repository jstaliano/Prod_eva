<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
        <a class="navbar-brand" href="#"><img src="./img/start.png" width="30" height="30"></a>
        <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="productcontrol.php">Produtos <span class="sr-only">(página atual)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="categorycontrol.php">Categorias</a>
                </li>
                <?php if ($_SESSION['nivel']==0):?>                    
                    <li class="nav-item active">                    
                        <a class="nav-link" href="usercontrol.php">Usuários</a>
                <?php else: ?>
                    <li class="nav-item">                    
                        <a class="nav-link disabled" tabindex="-1" aria-disabled="true" href="#">Usuários</a>
                <?php endif; ?>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="./logout.php">Sair</a>
                </li>
            </ul>
        </div>
    </nav>
</header>