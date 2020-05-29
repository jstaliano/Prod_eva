<!doctype html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Tela de Login do Usuário para controle de Produtos">
        <meta name="author" content="Julio Cesar Staliano">
        <title>Login - Área Restrita</title>        
        <link href="../css/bootstrap.css" rel="stylesheet">       
        <link href="../css/sign-in.css" rel="stylesheet">
    </head>
<body class="text-center">
    <?php    $usuario = isset($_GET['user']) ? $_GET['user'] : '';    ?>
     <form class="form-signin" method="POST" action="login.php" >
            <img class="mb-4" src="../img/start.png" alt="" width="72" height="72">
            <h1 class="h3 mb-3 font-weight-normal">Login</h1>
            <label for="inputEmail" class="sr-only">E-mail</label>
            <input type="email" id="inputEmail" class="form-control" placeholder=<?php echo $usuario; ?> required autofocus>
            <label for="inputPassword" class="sr-only">Senha Atual</label>
            <input type="password" id="inputPassword" class="form-control" placeholder="Senha" required>            
            <label for="inputPassword1" class="sr-only">Nova Senha</label>
            <input type="password" id="inputPassword1" class="form-control" placeholder="Nova Senha" required>
            <label for="inputPassword2" class="sr-only">Redigite Nova Senha</label>
            <input type="password" id="inputPassword2" class="form-control" placeholder="Repita a Nova Senha" required>
            
            <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
            <p class="mt-5 mb-3 text-muted">&copy; 2020[1.0]</p>
        </form>

        <script src="../assets/js/jquery.min.js"></script>
        <script src="../assets/js/popper.js"></script>
        <script src="../bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>