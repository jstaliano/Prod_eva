<?php
//session_start(); 
//require_once 'init.php';
//session_checker();
//$log=isLoggedIn();
    $parametro = isset($_POST['pesquisaCliente']) ? $_POST['pesquisaCliente'] : null;
    $msg = '';   
    $msg .='            <table class="table table-sm table-striped table-hover">';
    $msg .='                <tr class="table-active">';
    $msg .='                    <th>Nome do Usuário</th>';
    $msg .='                    <th>Login</th>';
    $msg .='                    <th>E-Mail</th>';
    $msg .='                    <th>Nível de Acesso</th>';
    $msg .='                    <th>Último Login em:</th>';    
    $msg .='                    <th></th>';    
    $msg .='                    <th>Ações P/ Este Usuário</th>';    
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
                                    $msg .='<td >'.$user->UserNivel.'</td>';
                                    $msg .='<td >'.date("d/m/Y",strtotime($user->LastLoginDate)).'</td>';
                                    $msg .='<td >'.$user->LastLoginHour.'</td>';
                                    if (true):
                                        $msg .='<td><button type="button" id="editbtn" class="btn btn danger editbtnuser"><i class="fas fa-edit" style="font-size: 40px; color:   Dodgerblue;"></i></button>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#?'.$user->UserId.'"><i class="fas fa-trash" style="font-size: 20px; color: red;  "></i></a></td>';       
                                    else:
                                        $msg .='<td><i class="fas fa-ban" style="font-size: 20px; color:red;"></i>&nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-banh" style="font-size: 20px; color: red;"></i></td>';       
                                    endif;
                                $msg .='</tr>';
                            endforeach;
                            $msg .='</table>';
                        else:
                            $msg = "";
                            $msg .="Nenhum Usuário foi encontrado...";
                        endif;        
    echo $msg;
    
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


        //$('#1')val(data[5])
        //$('#univel option[value=data[5]]').attr('selected','selected');
        //$('#univel').offsetParent.val=data[5]
        
        
        

    });
});

</script>
