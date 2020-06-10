<?php
date_default_timezone_set('America/Sao_Paulo'); 
 require_once('./funcoes/conexao.php'); 
 $conexao = conexao::getInstance();
if(isset($_POST['insertuser'])):
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $login = $_POST['login'];
    $senha = $_POST['senha'];
    $nivel = $_POST['nivel'];
    $lastdate = date('Y/m/d');
    $lasthour = date('H:i:s');
    //echo $nome.'-'.$email.'-'.$login.'-'.$senha.'-'.$nivel.'-'.$lastdate.'-'.$lasthour;

    
    
    $sql = 'INSERT INTO users (UserName,UserEmail,UserLogin,UserNivel,LastLoginDate,LastLoginHour,UserPassword)
				VALUES(:nome,:email,:l,:nivel,:lastdate,:lasthour,:p)';			
	$stm = $conexao->prepare($sql);			
	$stm->bindValue(':nome', $nome);
	$stm->bindValue(':email', $email);
	$stm->bindValue(':l', $login);
	$stm->bindValue(':nivel', $nivel);	
	$stm->bindValue(':lastdate', $lastdate);
    $stm->bindValue(':lasthour', $lasthour);			
    $stm->bindValue(':p', $senha);
    $retorno = $stm->execute();
    
    if($retorno):
        echo '<script> alert("Dados Salvos!");</script>';
        header('Location: usercontrol.php');
    else:
        echo '<script> alert("Falha ao Salvar!!");</script>';
    endif;
endif;
?>