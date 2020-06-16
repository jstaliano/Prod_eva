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
    if(isset($_POST['updateproduct'])):
        
        $codigo     = $_POST['ucodigo'];    
        $ncm        = $_POST['uncm'];
        $nome       = $_POST['unome'];
        $categoria  = $_POST['ucategoria'];
        $img        = $_POST['ufoto'];    
        $foto       = (isset($_FILES['uimg']['name'])) ? $_FILES['uimg']['name'] : '';    
        $extensao = strtolower(substr($_FILES['uimg']['name'], -4)); 
       // $extensao = strtolower(substr($_FILES['img']['name'], -4));
        $novo_nome1 = Date('Y-m-d').'_'.uniqid().$extensao;   
        $diretorio = './fotos/';    
        if ($_FILES['uimg']['error']<>4):            
            move_uploaded_file($_FILES['uimg']['tmp_name'], $diretorio.$novo_nome1);       
            $sql = 'UPDATE products SET ProductCode=:code,ProductNCM=:ncm,ProductName=:nome,ProductImage=:img,ProductCategoryId=:categoria WHERE ProductCode =:code';			
    	    $stm = $conexao->prepare($sql);			
    	    $stm->bindValue(':code', $codigo);
    	    $stm->bindValue(':ncm', $ncm);
    	    $stm->bindValue(':nome', $nome);    	
    	    $stm->bindValue(':categoria', $categoria);        
            $stm->bindValue(':img', $novo_nome1);	
            unlink($diretorio.$img);   
        else:            
            $sql = 'UPDATE products SET ProductCode=:code,ProductNCM=:ncm,ProductName=:nome,ProductCategoryId=:categoria WHERE ProductCode =:code';			
    	    $stm = $conexao->prepare($sql);			
    	    $stm->bindValue(':code', $codigo);
    	    $stm->bindValue(':ncm', $ncm);
    	    $stm->bindValue(':nome', $nome);    	
    	    $stm->bindValue(':categoria', $categoria);                    
        endif;
        $retorno = $stm->execute();
        if($retorno):
            echo "<div class='alert alert-primary text-center' style='margin-top:25px;' role='alert'><h4>Cadastro Atualizado com sucesso !!!</h4> </div> ";
            echo "<meta http-equiv=refresh content='1;URL=productcontrol.php'>"; 
        else:
            echo '<script> alert("Falha ao Salvar!!");</script>';
        endif;
    elseif (isset($_POST['deleteproduct'])):
        $codigo     = $_POST['dcodigo'];        
        $nome       = $_POST['dnome'];    
        $img        = $_POST['dfoto'];    
        $diretorio = './fotos/';    
        $sql = 'DELETE FROM products WHERE ProductCode =:code';			
    	$stm = $conexao->prepare($sql);			
    	$stm->bindValue(':code', $codigo);	
        $retorno = $stm->execute();
        unlink($diretorio.$img);    
        if($retorno):
            echo "<div class='alert alert-primary text-center' style='margin-top:25px;' role='alert'><h4>Cadastro Deletado com sucesso !!!</h4> </div> ";
            echo "<meta http-equiv=refresh content='1;URL=productcontrol.php'>"; 
        else:
            echo '<script> alert("Falha ao Salvar!!");</script>';
        endif;
    elseif(isset($_POST['insertproduct'])):
        $codigo = $_POST['codigo'];
        $ncm = $_POST['ncm'];
        $nome = $_POST['nome'];
        $categoria = $_POST['categoria'];
        $img = $_FILES['img'];
        $createddate = date('Y/m/d');
        $dia = Date('d');
        $ano = Date('Y');
        $flag = $ano.$dia;    
        //print_r($_FILES);
        $extensao = strtolower(substr($_FILES['img']['name'], -4));
        $novo_nome1 = Date('Y-m-d').'_'.uniqid().$extensao; 
        $diretorio = './fotos/';    
        $sql = 'INSERT INTO products (ProductCode,ProductNCM,ProductName,ProductImage,ProductCategoryId,ProductCreatedDate)
                    VALUES(:code,:ncm,:nome,:img,:categoria,:created)';			
        $stm = $conexao->prepare($sql);			
        $stm->bindValue(':code', $codigo);
        $stm->bindValue(':ncm', $ncm);
        $stm->bindValue(':nome', $nome);
        $stm->bindValue(':img', $novo_nome1);	
        $stm->bindValue(':categoria', $categoria);
        $stm->bindValue(':created', $createddate);			    
        $retorno = $stm->execute();
        move_uploaded_file($_FILES['img']['tmp_name'], $diretorio.$novo_nome1);       
        if($retorno):
            echo "<div class='alert alert-primary text-center' style='margin-top:25px;' role='alert'><h4>Produto Incluído com sucesso !!!</h4> </div> ";
            echo "<meta http-equiv=refresh content='1;URL=productcontrol.php'>"; 
        else:
            echo "<div class='alert alert-danger text-center' style='margin-top:25px;' role='alert'><h4>Falha na Gravação !!!</h4> </div> ";
            echo "<meta http-equiv=refresh content='2;URL=productcontrol.php'>"; 
        endif;

    endif;
endif;
?>
   