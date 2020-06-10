<?php
date_default_timezone_set('America/Sao_Paulo'); 
 require_once('./funcoes/conexao.php'); 
 $conexao = conexao::getInstance();
 
if(isset($_POST['updatecategory'])):
    
    
    $id         = $_POST['uidcat'];        
    $nome       = $_POST['unomecat'];
    $descricao  = $_POST['udescricaocat'];
    $data       = $_POST['udatacat'];
    $sql = 'UPDATE categories SET CategoryName=:nome, CategoryDescription=:descricao WHERE CategoryId =:id';			
	$stm = $conexao->prepare($sql);			
	$stm->bindValue(':id', $id);
	$stm->bindValue(':nome', $nome);
	$stm->bindValue(':descricao', $descricao);	
    $retorno = $stm->execute();    
    if($retorno):
        echo '<script> alert("Dados atualizados!");</script>';
        header('Location: categorycontrol.php');
    else:
        echo '<script> alert("Falha ao Salvar!!");</script>';
        echo "FALHA!";
    endif;
    
endif;
?>
   