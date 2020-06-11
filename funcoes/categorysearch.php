<?php
session_start(); 
require_once 'init.php';
session_checker();
$log=isLoggedIn();

if ($log=='1'): 
    $parametro = isset($_POST['pesquisaCliente']) ? $_POST['pesquisaCliente'] : null;
    

    $msg = '';   
    $msg .='            <table class="table table-sm table-striped table-hover">';
    $msg .='                    <tr class="table-active">';
    $msg .='                    <th>Id Categoria</th>';
    $msg .='                    <th>Nome da Categoria</th>';
    $msg .='                    <th>Descrição da Categoria</th>';    
    $msg .='                    <th>Data de Inclusão</th>';    
    $msg .='                    <th>Ações P/ Esta Categoria</th>';    
    $msg .='                </tr>';
                require_once('conexao.php');
                $conexao = conexao::getInstance();
                    try {                       
                        if (empty($parametro)):    
                            $sql = "SELECT CategoryId,CategoryName,CategoryDescription,CreatedDate FROM categories ORDER BY CategoryName";  
                        else:                             
                            $sql = "SELECT CategoryId,CategoryName,CategoryDescription,CreatedDate FROM categories WHERE CategoryName LIKE '%$parametro%' ORDER BY CategoryName";
                        endif;
                        $stm = $conexao->prepare($sql);                        
                        $stm->execute();
                        $categories = $stm->fetchAll(PDO::FETCH_OBJ);                                 
                        }catch (PDOException $e){
                            echo $e->getMessage();
                        }                          
                        if(count($categories)):                           
                            foreach($categories as $category):
                                $msg .='</tr>';                                                                        
                                    $msg .='<td >'.$category->CategoryId.'</td>';
                                    $msg .='<td >'.$category->CategoryName.'</td>';
                                    $msg .='<td >'.$category->CategoryDescription.'</td>';
                                    $msg .='<td >'.$category->CreatedDate.'</td>';                                    
                                    if (true):
                                        $msg .='<td><button type="button" id="editbtncat" class="btn btn danger editbtncat"><i class="fas fa-edit" style="font-size: 30px; color:   Dodgerblue;"></i></button>&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" id="deletebtncat" class="btn btn danger deletebtncat"><i class="fas fa-trash" style="font-size: 30px;color:red;"></i></button></td>';       
                                    else:
                                        $msg .='<td><i class="fas fa-ban" style="font-size: 20px; color:red;"></i>&nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-banh" style="font-size: 20px; color: red;"></i></td>';       
                                    endif;
                                $msg .='</tr>';
                            endforeach;
                            $msg .='        </table>';
                        else:
                            $msg = "";
                            $msg .="Nenhum Produto foi encontrado...";
                        endif;        
    echo $msg;    
endif;
?>

<script >
  $(document).ready(function (){
    $('.editbtncat').on('click',function () {        
        $('#editmodalcat').modal('show')         
        $tr = $(this).closest('tr')        
        var data = $tr.children("td").map(function() {
            return $(this).text()
        }).get();
        console.log(data);        
        $('#uidcat').val(data[0])
        $('#unomecat').val(data[1])
        $('#udescricaocat').val(data[2])        
        $('#udatacat').val(data[3])
    });
});
</script>
<script >
  $(document).ready(function (){
    $('.deletebtncat').on('click',function () {        
        $('#deletemodalcat').modal('show')         
        $tr = $(this).closest('tr')        
        var data = $tr.children("td").map(function() {
            return $(this).text()
        }).get();
        console.log(data);        
        $('#didcat').val(data[0])
        $('#dnomecat').val(data[1])
        $('#ddescricaocat').val(data[2])        
        $('#ddatacat').val(data[3])
    });
});
</script>