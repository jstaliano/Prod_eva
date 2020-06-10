<?php
date_default_timezone_set('America/Sao_Paulo'); 
 require_once('./funcoes/conexao.php'); 
 $conexao = conexao::getInstance();
if(isset($_POST['insertuser'])):
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];    
    $lastdate = date('Y/m/d');    
    //echo $nome.'-'.$email.'-'.$login.'-'.$senha.'-'.$nivel.'-'.$lastdate.'-'.$lasthour;

    
    
    $sql = 'INSERT INTO categories (CategoryName,CategoryDescription,CreatedDate)
				VALUES(:nome,:descricao,:lastdate)';			
	$stm = $conexao->prepare($sql);			
	$stm->bindValue(':nome', $nome);
	$stm->bindValue(':descricao', $descricao);	
	$stm->bindValue(':lastdate', $lastdate);
    $retorno = $stm->execute();
    if($retorno):
        echo '<script type="text/javascript"> alert("Dados Salvos!");</script>';
        header('Location: categorycontrol.php');
    else:
        echo '<script> alert("Falha ao Salvar!!");</script>';
    endif;
endif;
?>