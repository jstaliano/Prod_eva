<?php
date_default_timezone_set('America/Sao_Paulo'); 
 require_once('./funcoes/conexao.php'); 
 $conexao = conexao::getInstance();
 
if(isset($_POST['updateproduct'])):
    $codigo     = $_POST['ucodigo'];    
    $ncm        = $_POST['uncm'];
    $nome       = $_POST['unome'];
    $categoria  = $_POST['ucategoria'];
    $img        = $_POST['ufoto'];    
    $foto       = (isset($_FILES['uimg'])) ? $_FILES['uimg'] : '';
    
   // echo $codigo.'-'.$ncm.'-'.$nome.'-'.$categoria.'-'.$img.'<br>';
    
    //$foto       = $_FILES['foto'];
    //echo strlen($img);
    /*if (isset($_FILES['uimg'])):
        echo 'veio imagem<br>';
        //echo strlen($foto);
        echo $_FILES['uimg']['name'].'<br>';
        echo strlen(substr($_FILES['uimg']['name'],0,-4)).'<br>';
        echo substr($_FILES['uimg']['name'],0,-4);
        
    endif;*/

    //$createddate = date('Y/m/d');
    //$dia = Date('d');
    //$ano = Date('Y');
    //$flag = $ano.$dia;    
    //print_r($_FILES);
    $extensao = strtolower(substr($_FILES['img']['name'], -4));
    //$novo_nome1 = Date('Y-m-d').'_'.uniqid().$extensao; 
    $diretorio = './fotos/';    
    $sql = 'UPDATE products SET ProductCode=:code,ProductNCM=:ncm,ProductName=:nome,ProductImage=:img,ProductCategoryId=:categoria WHERE ProductCode =:code';			
	$stm = $conexao->prepare($sql);			
	$stm->bindValue(':code', $codigo);
	$stm->bindValue(':ncm', $ncm);
	$stm->bindValue(':nome', $nome);
	$stm->bindValue(':img', $img);	
	$stm->bindValue(':categoria', $categoria);    
    $retorno = $stm->execute();
    if (isset($_FILES['uimg'])):
        move_uploaded_file($_FILES['uimg']['tmp_name'], $diretorio.$img);       
    endif;
    if($retorno):
        echo '<script> alert("Dados atualizados!");</script>';
        header('Location: Productcontrol.php');
    else:
        echo '<script> alert("Falha ao Salvar!!");</script>';
    endif;
    
endif;
?>
   