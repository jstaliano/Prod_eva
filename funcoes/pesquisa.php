<?php
$codigo = isset($_POST['codigo']) ? $_POST['codigo'] : null;
$updatecodigo = isset($_POST['ucodigo']) ? $_POST['ucodigo'] : null;
$updateidcodigo = isset($_POST['uidcodigo']) ? $_POST['uidcodigo'] : null;

require_once("conexao.php");
$conn =  conexao::getInstance();
if (isset($_POST['ucodigo'])):
    
endif;


if (isset($_POST['codigo'])):
    $sql = "SELECT ProductId,ProductCode FROM products WHERE ProductCode = $codigo";
    $stm = $conn->prepare($sql);                        
    $stm->execute();
    $codefound = $stm->fetchAll(PDO::FETCH_OBJ);                                
    if(count($codefound)>0): 
        echo "Achei";
    else:
        echo 'Não Achei';
    endif;
elseif (isset($_POST['ucodigo'])):
    $sql = "SELECT ProductId,ProductCode FROM products WHERE ProductId = $updateidcodigo";
    $stm = $conn->prepare($sql);
    $stm->execute();
    $idcodefound = $stm->fetch(PDO::FETCH_OBJ);
    if ($idcodefound->ProductCode == $updatecodigo):
        echo 'Não Achei';
    else:
        $sql = "SELECT ProductId,ProductCode FROM products WHERE ProductCode = $updatecodigo";
        $stm = $conn->prepare($sql);                        
        $stm->execute();
        $codefound = $stm->fetchAll(PDO::FETCH_OBJ);                                
        if(count($codefound)>0): 
            echo "Achei";
        else:
            echo 'Não Achei';
        endif;
    endif;
    
endif;
    
    
?>