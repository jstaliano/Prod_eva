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
            echo "<div class='alert alert-primary text-center' style='margin-top:25px;' role='alert'><h4>Categoria atualizada com sucesso !!!</h4> </div> ";
            echo "<meta http-equiv=refresh content='1;URL=categorycontrol.php'>"; 
        else:
            echo '<script> alert("Falha ao Salvar!!");</script>';
            echo "FALHA!";
        endif;
    elseif(isset($_POST['deletecategory'])):
        $id         = $_POST['didcat'];            
        $sql = 'DELETE FROM categories WHERE CategoryId =:id';			
        $stm = $conexao->prepare($sql);			
        $stm->bindValue(':id', $id);    
        $retorno = $stm->execute();    
        if($retorno):
            echo "<div class='alert alert-primary text-center' style='margin-top:25px;' role='alert'><h4>Categoria Deletada com sucesso !!!</h4> </div> ";
            echo "<meta http-equiv=refresh content='1;URL=categorycontrol.php'>"; 
        else:
            echo '<script> alert("Falha ao Salvar!!");</script>';
            echo "FALHA!";
        endif;    
    elseif(isset($_POST['insertcat'])):
        $nome = $_POST['nome'];
        $descricao = $_POST['descricao'];    
        $lastdate = date('Y/m/d');  
        $sql = 'INSERT INTO categories (CategoryName,CategoryDescription,CreatedDate)
                    VALUES(:nome,:descricao,:lastdate)';			
        $stm = $conexao->prepare($sql);			
        $stm->bindValue(':nome', $nome);
        $stm->bindValue(':descricao', $descricao);	
        $stm->bindValue(':lastdate', $lastdate);
        $retorno = $stm->execute();
        if($retorno):
            echo "<div class='alert alert-primary text-center' style='margin-top:25px;' role='alert'><h4>Categoria Incluída com sucesso !!!</h4> </div> ";
            echo "<meta http-equiv=refresh content='1;URL=categorycontrol.php'>"; 
        else:
            echo '<script> alert("Falha ao Salvar!!");</script>';
        endif;

    endif;
endif;
?>