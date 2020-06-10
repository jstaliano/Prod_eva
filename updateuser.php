<?php
date_default_timezone_set('America/Sao_Paulo'); 
 require_once('./funcoes/conexao.php'); 
 $conexao = conexao::getInstance();
 
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
        echo '<script> alert("Dados atualizados!");</script>';
        header('Location: usercontrol.php');
    else:
        echo '<script> alert("Falha ao Salvar!!");</script>';
        echo "FALHA!";
    endif;
    
endif;
?>
   