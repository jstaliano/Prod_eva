<?php
//session_start(); 
//require_once 'init.php';
//session_checker();
//$log=isLoggedIn();
    $parametro = isset($_POST['pesquisaCliente']) ? $_POST['pesquisaCliente'] : null;
    $msg = '';   
    $msg .='            <table class="table table-sm table-striped table-hover">';
    $msg .='                <tr class="table-active">';
    $msg .='                 <th>Id Produto</th>';
    $msg .='                 <th>Imagem</th>';
    $msg .='                 <th>Categoria</th>';
    $msg .='                 <th>Descrição do Produto</th>';
    $msg .='                 <th>Data</th>';    
    $msg .='                 <th>Ações</th>';    
    $msg .='                </tr>';
                require_once('funcoes/conexao.php');
                $conexao = conexao::getInstance();
                    try {                       
                        if (empty($parametro)):    
                            $sql = "SELECT id,nomearq,datainc FROM tabarquivo ORDER BY datainc DESC";  
                        else:                            
                            $sql = "SELECT id,nomearq,datainc FROM tabarquivo WHERE nomearq LIKE '%$parametro%'";
                        endif;
                        $stm = $conexao->prepare($sql);                        
                        $stm->execute();
                        $clientes = $stm->fetchAll(PDO::FETCH_OBJ);                                 
                        }catch (PDOException $e){
                            echo $e->getMessage();
                        }                           
                        if(count($clientes)):                           
                    foreach($clientes as $cliente):
    $msg .='                <tr>';
    $msg .='                <th >'.$cliente->id.'</th>';
    $msg .='                <th ><img src="fotos/'.$cliente->nomearq.'" width="150"></td>';
    $msg .='                <th >Categoria</td>';
    $msg .='                <th >'.$cliente->nomearq.'</td>';
    $msg .='                <td>'.$cliente->datainc.'</td>';   
    $msg .='                <td><i class="fas fa-edit" style="font-size: 20px; color: Dodgerblue;"></i>&nbsp;&nbsp;<i class="fas fa-trash" style="font-size: 20px; color: red;"></i></td>';       
    $msg .='                </tr>';
                    endforeach;
    $msg .='        </table>';
                        else:
                            $msg = "";
                            $msg .="Nenhum resultado foi encontrado...";
                        endif;        
    echo $msg;
?>