<?php
session_start(); 
require 'init.php';
session_checker();
$log=isLoggedIn();
if ($log=='1'):
    $parametro = isset($_POST['pesquisaCliente']) ? $_POST['pesquisaCliente'] : null;
    $msg = '';   
    $msg .='            <table class="table table-sm table-striped table-hover">';
    $msg .='                <tr class="table-active">';
    $msg .='                    <th>Nome do Usuário</th>';
    $msg .='                    <th>Login</th>';
    $msg .='                    <th>E-Mail</th>';
    $msg .='                    <th style="text-align:center">Nível de Acesso</th>';
    $msg .='                    <th style="text-align:center">Último Login em:</th>';        
    $msg .='                    <th style="text-align:right">Ações P/ Este Usuário</th>';    
    $msg .='                </tr>';
                require_once('conexao.php');
                $conexao = conexao::getInstance();
                    try {                       
                        if (empty($parametro)):
                            $sql = "SELECT UserId,UserName,UserLogin,UserEmail,UserNivel,LastLoginDate,LastLoginHour FROM users";
                        else:                            
                            $sql = "SELECT UserId,UserName,UserLogin,UserEmail,UserNivel,LastLoginDate,LastLoginHour FROM users WHERE UserName LIKE '%$parametro%'";
                        endif;
                        $stm = $conexao->prepare($sql);                        
                        $stm->execute();
                        $users = $stm->fetchAll(PDO::FETCH_OBJ);                                 
                        }catch (PDOException $e){
                            echo $e->getMessage();
                        }                          
                        if(count($users)>0):                           
                            foreach($users as $user):
                                $msg .='</tr>';
                                    $msg .='<td style="display:none;" >'.$user->UserId.'</td>';
                                    $msg .='<td >'.$user->UserName.'</td>';
                                    $msg .='<td style="Color:#dc3545;" >'.$user->UserLogin.'</td>';
                                    $msg .='<td >'.$user->UserEmail.'</td>';
                                    if ($user->UserNivel==0):
                                        $msg .='<td style="color:green;font-weight:bold;text-align:center">Administrativo</td>';
                                    elseif ($user->UserNivel==1):
                                        $msg .='<td style="color:red;font-weight:bold;text-align:center">Comum</td>';
                                    endif;
                                    $msg .='<td style="text-align:center">'.date("d/m/Y",strtotime($user->LastLoginDate)).' às '.$user->LastLoginHour.'</td>';
                                    //$msg .='<td >'.$user->LastLoginHour.'</td>';
                                    if ($_SESSION['nivel']==0):
                                        $msg .='<td style="text-align:right"><button type="button" id="editbtn" class="btn btn danger editbtnuser"><i class="fas fa-user-edit" style="font-size: 30px; color:   Dodgerblue;"></i></button>&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" id="deletetbtnuser" class="btn btn danger deletebtnuser"><i class="fas fa-user-times" style="font-size: 30px; color: red;  "></i></a>&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" id="deletetbtnuser" class="btn btn danger resetbtnuser"><i class="fas fa-user-cog" style="font-size: 30px; color: purple;  "></i></a></td>';       
                                    else:
                                        $msg .='<td><i class="fas fa-ban" style="font-size: 20px; color:red;"></i>&nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-banh" style="font-size: 20px; color: red;"></i></td>';       
                                    endif;
                                $msg .='</tr>';
                            endforeach;
                            $msg .='</table>';
                        else:
                            $msg = "";
                            echo "<div class='alert alert-warning text-center' style='margin-top:25px;' role='alert'><h4>Nenhum Usuário Encontrado Com Esse Nome!</h4> </div> ";
                            //$msg .="Nenhum Usuário foi encontrado...";
                        endif;        
    echo $msg;    
endif;
?>
<script >
  $(document).ready(function (){
    $('.editbtnuser').on('click',function () {        
        $('#editmodaluser').modal('show')         
        $tr = $(this).closest('tr')        
        var data = $tr.children("td").map(function() {
            return $(this).text()
        }).get();
        console.log(data);
        $('#uiduser').val(data[0])
        $('#unome').val(data[1])
        $('#uemail').val(data[3])
        $('#ulogin').val(data[2])
        $('#usenha').val(data[7])
        $('#univel').val(data[4])
        $('#udata').val(data[5])
        $('#uhora').val(data[6])
    });
});
</script>
<script >
  $(document).ready(function (){
    $('.deletebtnuser').on('click',function () {        
        $('#deletemodaluser').modal('show')         
        $tr = $(this).closest('tr')        
        var data = $tr.children("td").map(function() {
            return $(this).text()
        }).get();
        console.log(data);
        $('#diduser').val(data[0])
        $('#dnome').val(data[1])
        $('#demail').val(data[3])
        $('#dlogin').val(data[2])       
    });
});
</script>
<script >
  $(document).ready(function (){
    $('.resetbtnuser').on('click',function () {        
        $('#resetmodaluser').modal('show')         
        $tr = $(this).closest('tr')        
        var data = $tr.children("td").map(function() {
            return $(this).text()
        }).get();
        console.log(data);
        $('#ziduser').val(data[0])
        $('#znome').val(data[1])
        $('#zemail').val(data[3])
        $('#zlogin').val(data[2])       
    });
});
</script>
