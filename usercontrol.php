<?php
date_default_timezone_set('America/Sao_Paulo');

/* Inicia a sessão */
session_start(); 
require_once 'funcoes/init.php';
require_once 'funcoes/conexao.php';
session_checker();
$log=isLoggedIn();
?>
<!DOCTYPE html>
<html>
<head>
    <html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Tela de Login do Usuário para controle de Produtos">
        <link rel="icon" href="img/start.ico">
        <meta name="author" content="Julio Cesar Staliano">               
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/712f8f6219.js" crossorigin="anonymous"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                function loading_show() {
                    $('#loading').html("<i class='fas fa-hourglass-start' style='font-size: 28px; color: Dodgerblue;'></i>").fadeIn('fast');
                }
                function loading_hide() {
                    $('#loading').fadeOut('fast');
                }
                function load_dados(valores, page, div) {
                    $.ajax({
                        type: 'POST',
                        dataType: 'html',
                        url: page,
                        beforeSend: function() {
                            loading_show();
                        },
                        data: valores,
                        success: function(msg) {
                            loading_hide();
                            var data = msg;
                            $(div).html(data).fadeIn();
                        }
                    });
                }
                load_dados(null, './funcoes/usersearch.php', '#MostraPesq');
                $('#pesquisaCliente').keyup(function() {
                    var valores = $('#form_pesquisa').serialize()
                    var $parametro = $(this).val();
                    if ($parametro.length >= 1) {
                        load_dados(valores, './funcoes/usersearch.php', '#MostraPesq');
                    } else {
                        load_dados(null, './funcoes/usersearch.php', '#MostraPesq');
                    }
                });

            });
        </script>
    </head>

<body>
    <?php $log=isLoggedIn(); 
    if ($log=='1'):    
        if ($_SESSION['nivel']==0):
            include 'funcoes/userheader.php';
            ?>    
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">                
                        <hr class="btn-warning" />
                        <div id="contentLoading">
                            <div id="loading"></div>
                        </div>
                        <section class="pt-5">
                            <div id="MostraPesq"></div>
                        </section>
                    </div>
                </div>
            </div>
         <?php else: 
            echo "<div class='alert alert-danger text-center' style='margin-top:25px;' role='alert'><h4>Você não tem permissão!</h4> </div> ";
            echo "<meta http-equiv=refresh content='1;URL=index.php'>"; 
        endif; 
    endif; 
    //include 'footer.php'; 
    ?>    
    <script type="text/javascript" src="js/custom.js"></script>
</body>
</html>