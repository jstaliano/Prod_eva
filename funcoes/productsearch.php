<?php
session_start(); 
require_once 'init.php';
session_checker();
$log=isLoggedIn();
if ($log=='1'): 
    $parametro = isset($_POST['pesquisaCliente']) ? $_POST['pesquisaCliente'] : null;
    $msg = '';   
    $msg .='            <table class="table table-sm table-striped table-hover" style="margin-top: 25px;">';
    $msg .='                    <tr class="table-active">';   
    $msg .='                    <th>Foto do Produto</th>';
    $msg .='                    <th>Código Produto</th>';
    $msg .='                    <th>NCM do Produto</th>';
    $msg .='                    <th>Categoria</th>';
    $msg .='                    <th>Descrição do Produto</th>';    
    $msg .='                    <th>Ações P/ Este Produto</th>';    
    $msg .='                </tr>';
                require_once('conexao.php');
                $conexao = conexao::getInstance();
                    try {                       
                        if (empty($parametro)):    
                            $sql = "SELECT ProductId,ProductCode,ProductNCM,ProductName,ProductImage,ProductCategoryId FROM products ORDER BY ProductCategoryId DESC";  
                        else:                             
                            $sql = 'SELECT ProductId,ProductCode,ProductNCM,ProductName,ProductImage,ProductCategoryId FROM products WHERE ProductName LIKE "%$parametro%"';
                        endif;
                        $stm = $conexao->prepare($sql);                        
                        $stm->execute();
                        $products = $stm->fetchAll(PDO::FETCH_OBJ);                                 
                        }catch (PDOException $e){
                            echo $e->getMessage();
                        }                          
                        if(count($products)):                           
                            foreach($products as $product):
                                $msg .='</tr>';
                                    $msg .='<td style="display:none;" >'.$product->ProductImage.'</td>';
                                    $msg .='<td ><img src="./fotos/'.$product->ProductImage.'" width="180"></td>';
                                    $msg .='<td style="font-size:28px; align:Center; Color:#dc3545;" >'.$product->ProductCode.'</td>';
                                    $msg .='<td >'.$product->ProductNCM.'</td>';
                                    $msg .='<td >'.$product->ProductCategoryId.'</td>';
                                    $msg .='<td >'.$product->ProductName.'</td>';
                                    if ($_SESSION['nivel']==0):
                                        $msg .='<td><button type="button" id="editbtn" class="btn btn danger editbtn"><i class="fas fa-edit" style="font-size: 30px; color:   Dodgerblue;"></i></button>&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" id="editbtn" class="btn btn danger deletebtn"><i class="fas fa-trash" style="font-size:30px;color:red;"></i></button></td>';       
                                    else:
                                        $msg .='<td><i class="fas fa-ban" style="font-size: 20px; color:red;"></i>&nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-banh" style="font-size: 20px; color: red;"></i></td>';       
                                    endif;
                                $msg .='</tr>';
                            endforeach;
                            $msg .='        </table>';
                        else:
                            $msg = "";
                            echo "<div class='alert alert-warning text-center' style='margin-top:25px;' role='alert'><h4>Nenhum Produto Encontrado Com Essa Descrição!</h4> </div> ";
                            //$msg .="Nenhum Produto foi encontrado...";
                        endif;        
    echo $msg;
endif; 
?> 
<script >
  $(document).ready(function (){
    $('.editbtn').on('click',function () {        
        $('#editmodal').modal('show')         
        $tr = $(this).closest('tr')        
        var data = $tr.children("td").map(function() {
            return $(this).text()
        }).get();
        console.log(data);
        $('#ucodigo').val(data[2])
        $('#uncm').val(data[3])
        $('#unome').val(data[5])
        $('#ucategoria').val(data[4])
        $('#uimg').val(data[1])
        $('#ufoto').val(data[0])        
        $("#my_image").attr("src", "./fotos/" + data[0])
    });
});
</script>

<script >
  $(document).ready(function (){
    $('.deletebtn').on('click',function () {        
        $('#deletemodal').modal('show')         
        $tr = $(this).closest('tr')        
        var data = $tr.children("td").map(function() {
            return $(this).text()
        }).get();
        console.log(data);
        $('#dcodigo').val(data[2])
        
        $('#dnome').val(data[5])
        
        
        $('#dfoto').val(data[0])
        $("#dmy_image").attr("src", "./fotos/" + data[0])
    });
});
</script>
