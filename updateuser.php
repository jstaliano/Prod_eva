<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<!--<link rel="stylesheet" type="text/css" href="css/custom.css">-->
</head>
<body>
    
</body>
</html>
<?php
date_default_timezone_set('America/Sao_Paulo'); 
require_once('./funcoes/conexao.php'); 
session_start(); 
require_once 'funcoes/init.php';
require_once 'funcoes/conexao.php';
session_checker();
$log=isLoggedIn();
$conexao = conexao::getInstance(); 
$log=isLoggedIn(); 
if ($log=='1'): 
    if ($_SESSION['nivel']==0):
        if(isset($_POST['updateuser'])):
            $id         = $_POST['uiduser'];        
            $nome       = $_POST['unome'];
            $email      = $_POST['uemail'];    
            $nivel      = $_POST['univel'];
            $sql = 'UPDATE users SET UserName=:nome,UserEmail=:email,UserNivel=:nivel WHERE UserId =:id';			
        	$stm = $conexao->prepare($sql);			
        	$stm->bindValue(':id', $id);
        	$stm->bindValue(':nome', $nome);
        	$stm->bindValue(':email', $email);
        	$stm->bindValue(':nivel', $nivel);	
            $retorno = $stm->execute();    
            if($retorno):
                echo "<div class='alert alert-primary text-center' style='margin-top:25px;' role='alert'><h4>Cadastro Atualizado com sucesso !!!</h4> </div> ";
                echo "<meta http-equiv=refresh content='1;URL=usercontrol.php'>"; 
            else:
                echo '<script> alert("Falha ao Salvar!!");</script>';
                echo "FALHA!";
            endif;
        elseif(isset($_POST['resetuser'])):
            $id         = $_POST['ziduser'];                    
            $reset=1;
            $senhaHash = make_hash('123mudar');
            $sql = 'UPDATE users SET UserSet=:userset, UserPassword=:pass WHERE UserId =:id';			
            $stm = $conexao->prepare($sql);			
            $stm->bindValue(':id', $id);
            $stm->bindValue(':userset', $reset);
            $stm->bindValue(':pass', $senhaHash);            
            $retorno = $stm->execute();    
            if($retorno):
                echo "<div class='alert alert-warning text-center' style='margin-top:25px;' role='alert'><h4>Reconfigurado a Senha do Usuário com Sucesso !!</h4> </div> ";
                echo "<meta http-equiv=refresh content='1;URL=usercontrol.php'>"; 
            else:
                echo '<script> alert("Falha ao Salvar!!");</script>';
                echo "FALHA!";
            endif;
        elseif(isset($_POST['deleteuser'])):    
            $id  = $_POST['diduser'];    
            $sql = 'DELETE FROM users WHERE UserId =:id';			
        	$stm = $conexao->prepare($sql);			
        	$stm->bindValue(':id', $id);	
            $retorno = $stm->execute();    
            if($retorno):
                echo "<div class='alert alert-primary text-center' style='margin-top:25px;' role='alert'><h4>Cadastro Deletado com sucesso !!!</h4> </div> ";
                echo "<meta http-equiv=refresh content='1;URL=usercontrol.php'>"; 
            else:
                echo '<script> alert("Falha ao Salvar!!");</script>';
                echo "FALHA!";
            endif;
        elseif(isset($_POST['insertuser'])):
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $login = $_POST['login'];
            $senha = $_POST['senha'];
            $nivel = $_POST['nivel'];
            $lastdate = date('Y/m/d');
            $lasthour = date('H:i:s');
            $senhaHash = make_hash($senha);
            $sql = 'INSERT INTO users (UserName,UserEmail,UserLogin,UserNivel,LastLoginDate,LastLoginHour,UserPassword)
                        VALUES(:nome,:email,:l,:nivel,:lastdate,:lasthour,:p)';			
            $stm = $conexao->prepare($sql);			
            $stm->bindValue(':nome', $nome);
            $stm->bindValue(':email', $email);
            $stm->bindValue(':l', $login);
            $stm->bindValue(':nivel', $nivel);	
            $stm->bindValue(':lastdate', $lastdate);
            $stm->bindValue(':lasthour', $lasthour);			
            $stm->bindValue(':p', $senhaHash);
            $retorno = $stm->execute();    
            if($retorno):
                echo "<div class='alert alert-primary text-center' style='margin-top:25px;' role='alert'><h4>Cadastro Incluído com sucesso !!!</h4> </div> ";
                echo "<meta http-equiv=refresh content='1;URL=usercontrol.php'>"; 
            else:
                echo '<script> alert("Falha ao Salvar!!");</script>';
            endif;
        endif;
    else: 
        echo "<div class='alert alert-danger text-center' style='margin-top:25px;' role='alert'><h4>Você não tem permissão!</h4> </div> ";
        echo "<meta http-equiv=refresh content='1;URL=index.php'>"; 
    endif; 
endif;
?>
   