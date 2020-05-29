<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Tela de Login do Usuário para controle de Produtos">
    <meta name="author" content="Julio Cesar Staliano">
    <title>Login - Área Restrita</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/sign-in.css" rel="stylesheet">
</head>

<body>
    <?php
    date_default_timezone_set('America/Sao_Paulo');
    // inclui o arquivo de inicialização
    require 'init.php';

    // resgata variáveis do formulário
    $usuario = isset($_POST['inputEmail']) ? $_POST['inputemail'] : '';
    $password = isset($_POST['inputPassword']) ? $_POST['inputPassword'] : '';
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
        echo "<meta http-equiv=refresh content='4;URL=index.php'>";
        exit;
    }


    $passwordHash = make_hash($password);

    $conexao = conexao::getInstance();
    $sql = "SELECT Id, Nome, Usuario, Nivel, DtHrUltimmoAcesso, Ativo, ResetPass FROM Tab_Users WHERE Usuario=:usuario AND senhapass = :senha ";
    $stm = $conexao->prepare($sql);
    $stmt->bindParam(':usuario', $usuario);
    $stmt->bindParam(':senhapass', $passwordHash);
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $user = $users[0];

    if (count($users) <= 0) :
        echo "<div class='alert alert-danger text-center' role='alert'><h3>Usuário ou Senha incorreto ... </h3></div> ";
        echo "<meta http-equiv=refresh content='4;URL=index.php'>";
        exit;
    elseif ($user['ativo'] == 0):
        echo "<div class='alert alert-danger text-center' role='alert'><h3>Usuário Não Permitido - Procure pelo Administrador ... </h3></div> ";
        echo "<meta http-equiv=refresh content='4;URL=index.php'>";
        exit;
    elseif (($user['qtde_acessos'] == 0 || $user['resetpass'] == 1) && $mudandodesenha <> 'mudasenha') :
        echo "<div class='alert alert-success text-center' role='alert'><h3>Troque a sua  Senha</h3></div> ";
        echo "<meta http-equiv=refresh content='3;URL=form_mudasenha.php?user=" . $usuario . "'>";
    elseif ($user['qtde_acessos'] > 0 and $mudandodesenha <> 'mudasenha') :
        $qtdeacesso = ($user['qtde_acessos']);
        $ident = $user['id'];
        $qtdeacesso++;
        $agora = date('Y-m-d H:i:s');
        $sql = 'UPDATE Tab_Users SET  dt_hr_ult_acesso=:agora, qtde_acessos=:qtdeacesso WHERE id =:id';
        $stmt = $PDO->prepare($sql);
        $stmt->bindValue(':id', $ident);
        $stmt->bindValue(':agora', $agora);
        $stmt->bindValue(':qtdeacesso', $qtdeacesso);
        $stmt->execute();
        session_start();
        $_SESSION['logged_in'] = true;
        $_SESSION['id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['nivel'] = $user['nivel'];
        $_SESSION['usuario'] = $user['usuario'];
        $_SESSION['tempo'] = date('H:i:s');
        $_SESSION['logado_desde'] = date('H:i:s');        
        echo "<div class='alert alert-success text-center' role='alert'><h3>Aguarde você está sendo redirecionado ... </h3></div> ";
        echo "<meta http-equiv=refresh content='1;URL=controle.php'>";
    elseif ($mudandodesenha = "mudasenha") :
        $passwordHash1 = make_hash($password1);
        $qtdeacesso = ($user['qtde_acessos']);
        $ident = $user['id'];
        $qtdeacesso++;
        $agora = date('Y-m-d H:i:s');
        $reset = 0;
        $sql = 'UPDATE Tab_Users SET  password=:pass, dt_hr_ult_acesso=:agora, qtde_acessos=:qtdeacesso,resetpass=:reset WHERE id =:id';
        $stmt = $PDO->prepare($sql);
        $stmt->bindValue(':id', $ident);
        $stmt->bindValue(':agora', $agora);
        $stmt->bindValue(':qtdeacesso', $qtdeacesso);
        $stmt->bindValue(':pass', $passwordHash1);
        $stmt->bindValue(':reset', $reset);
        $stmt->execute();
        session_start();
        $_SESSION['logged_in'] = true;
        $_SESSION['id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['nivel'] = $user['nivel'];
        $_SESSION['usuario'] = $user['usuario'];
        $_SESSION['tempo'] = date('H:i:s');
        $_SESSION['logado_desde'] = date('H:i:s');
        echo "<div class='alert alert-success text-center' role='alert'><h3>Aguarde você está sendo redirecionado ... </h3></div> ";
        echo "<meta http-equiv=refresh content='1;URL=index.php'>";
    endif;
    ?>
    <?php include 'footer.php'; ?>
    <script type="text/javascript" src="js/custom.js"></script>
</body>

</html>