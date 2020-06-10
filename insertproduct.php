<?php
date_default_timezone_set('America/Sao_Paulo'); 
 require_once('./funcoes/conexao.php'); 
 $conexao = conexao::getInstance();
if(isset($_POST['insertproduct'])):
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
        echo '<script> alert("Dados Salvos!");</script>';
        header('Location: Productcontrol.php');
    else:
        echo '<script> alert("Falha ao Salvar!!");</script>';
    endif;
endif;
?>
   