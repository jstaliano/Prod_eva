<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Tela de Login do Usuário para controle de Produtos">
    <link rel="icon" href="img/start.ico">
    <meta name="Julio Cesar Staliano" content="Processar Login">
    <title>Login - Área Restrita</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
</head>

<body>
    <?php
    date_default_timezone_set('America/Sao_Paulo');
    // inclui o arquivo de inicialização
    require 'init.php';
    require_once 'conexao.php';

    // resgata variáveis do formulário
    $usuario = isset($_POST['login']) ? $_POST['login'] : '';
    $password = isset($_POST['senha']) ? $_POST['senha'] : '';
    $password1 = isset($_POST['password1']) ? $_POST['password1'] : '';
    $password2 = isset($_POST['password2']) ? $_POST['password2'] : '';
    $mudandodesenha= isset($_POST['novasenha']) ? $_POST['novasenha'] : '';
    if (!empty($mudandodesenha)) :
        if ($password1 <> $password2) :
            echo "<div class='alert alert-success text-center' role='alert'><h3>Novas Senhas não são iguais!!!</h3></div> ";
            echo "<meta http-equiv=refresh content='3;URL=form_mudasenha.php?user=" . $usuario . "'>";
            exit;
        endif;
    endif;
    if (empty($usuario) || empty($password)) {
        echo "<div class='alert alert-danger text-center' role='alert'><h3>Informe o Usuário e ou a Senha ... </h3></div> ";
        echo "<meta http-equiv=refresh content='3;URL=../sign-in.html'>";
        exit;
    }    
    $passwordHash = make_hash($password);
    $conexao = conexao::getInstance();
    $sql = "SELECT UserId,UserName,UserEmail,UserLogin,UserNivel,LastLoginDate,LastLoginHour,UserPassword,UserAccess,UserSet FROM users WHERE UserLogin=:usuario AND UserPassword = :senha ";
    $stm = $conexao->prepare($sql);
    $stm->bindParam(':usuario', $usuario);
    $stm->bindParam(':senha', $passwordHash);
    $stm->execute();
    $users = $stm->fetchAll(PDO::FETCH_ASSOC);
    if ($users) {
        $user = $users[0];
    }
    if (count($users) <= 0) :
        echo "<div class='alert alert-danger text-center' role='alert'><h3>Usuário e/ou Senha incorreta ... </h3></div> ";
        echo "<meta http-equiv=refresh content='4;URL=../index.php'>";
        exit;    
    elseif (($user['UserAccess'] == 0 || $user['UserSet']==1) && $mudandodesenha <> 'mudasenha') :
        echo "<div class='alert alert-success text-center' role='alert'><h3>Troque a sua  Senha</h3></div> ";
        echo "<meta http-equiv=refresh content='3;URL=form_mudasenha.php?user=" . $usuario . "'>";
    elseif ($user['UserAccess'] > 0 and $mudandodesenha <> 'mudasenha') :
        $qtdeacesso = ($user['UserAccess']);
        $qtdeacesso++;
        $ident = $user['UserId'];        
        $diahoje = date('Y-m-d');
        $horahoje = date('H:i:s');
        $sql = 'UPDATE users SET  LastLoginDate=:diahoje,LastLoginHour=:horahoje, UserAccess=:qtdeacesso WHERE UserId =:id';
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':id', $ident);
        $stmt->bindValue(':diahoje', $diahoje);
        $stmt->bindValue(':horahoje', $horahoje);
        $stmt->bindValue(':qtdeacesso', $qtdeacesso);
        $stmt->execute();
        session_start();
        $_SESSION['logged_in'] = true;
        $_SESSION['id'] = $user['UserId'];
        $_SESSION['user_name'] = $user['UserName'];
        $_SESSION['nivel'] = $user['UserNivel'];
        $_SESSION['usuario'] = $user['UserLogin'];
        $_SESSION['tempo'] = date('H:i:s');
        $_SESSION['logado_desde'] = date('H:i:s');        
        echo "<div class='alert alert-success text-center' role='alert'><h3>Autenticado. Aguarde... </h3></div> ";
        echo "<meta http-equiv=refresh content='1;URL=../index.php'>";
    elseif ($mudandodesenha = "mudasenha") :
        $passwordHash1 = make_hash($password1);
        $qtdeacesso = ($user['UserAccess']);
        $qtdeacesso++;
        $userSet =0;
        $ident = $user['UserId'];        
        $diahoje = date('Y-m-d');
        $horahoje = date('H:i:s');        
        $sql = 'UPDATE users SET  UserPassword=:pass, LastLoginDate=:diahoje, LastLoginHour=:horahoje, UserAccess=:qtdeacesso, UserSet=:userset WHERE UserId =:id';
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':id', $ident);
        $stmt->bindValue(':diahoje', $diahoje);
        $stmt->bindValue(':horahoje', $horahoje);
        $stmt->bindValue(':qtdeacesso', $qtdeacesso);
        $stmt->bindValue(':userset', $userSet);
        $stmt->bindValue(':pass', $passwordHash1);        
        $stmt->execute();
        session_start();
        $_SESSION['logged_in'] = true;
        $_SESSION['id'] = $user['UserId'];
        $_SESSION['user_name'] = $user['UserName'];
        $_SESSION['nivel'] = $user['UserNivel'];
        $_SESSION['usuario'] = $user['UserLogin'];
        $_SESSION['tempo'] = date('H:i:s');
        $_SESSION['logado_desde'] = date('H:i:s');
        echo "<div class='alert alert-success text-center' role='alert'><h3>Alteramos sua Senha! Aguarde... </h3></div> ";
        echo "<meta http-equiv=refresh content='1;URL=../index.php'>";
    endif;
    ?>
    <?php include 'footer.php'; ?>
    <script type="text/javascript" src="js/custom.js"></script>
</body>

</html>