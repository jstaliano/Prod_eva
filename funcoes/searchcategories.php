<?php
require_once 'conexao.php';
$req=0;
//$req = $_POST['CategoryId'];
$req = 11;
        //if(isset($_POST['CategoryId'])):            
            $conexao = conexao::getInstance();
            $sql = "SELECT CategoryName FROM categories WHERE CategoryId=$req";  
            $stm = $conexao->prepare($sql);                        
            $stm->execute();
            $categories = $stm->fetchAll(PDO::FETCH_OBJ);
            $cat='';
            //$cat = ($categories[0]);
            //echo var_dump($cat);
            //print_r($categories);
            foreach ($categories as $category) {
                $cat = $category->CategoryName;
                
                
            }
        //else:
          //  echo 'Não Encontrei';
        //endif;
echo $cat;
//require 'conexao.php';


?>