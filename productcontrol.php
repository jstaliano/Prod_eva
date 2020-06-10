<?php
date_default_timezone_set('America/Sao_Paulo');

/* Inicia a sessão */
//session_start(); 
//require 'init.php';
require 'funcoes/conexao.php';
//include 'menunavbar.php';/
//session_checker();
//include 'menumenu.php'; 
//$log=isLoggedIn();

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
        <meta name="author" content="Julio Cesar Staliano">                        
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
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
                load_dados(null, './funcoes/productsearch.php', '#MostraPesq');
                $('#pesquisaCliente').keyup(function() {
                    var valores = $('#form_pesquisa').serialize()
                    var $parametro = $(this).val();
                    if ($parametro.length >= 1) {
                        load_dados(valores, './funcoes/productsearch.php', '#MostraPesq');
                    } else {
                        load_dados(null, './funcoes/productsearch.php', '#MostraPesq');
                    }
                });

            });
        </script>
    </head>

<body>
    <?php //$log=isLoggedIn(); 
    //if ($log=='1'):
    
    include 'funcoes/productheader.php';
    ?>
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <!--<form action="pesquisa.php" method="post" name="form_pesquisa" id="form_pesquisa">
                    <a href='incluir.html' class="btn btn-success">Cadastrar Novo Produto</a>
                    <button type="button" class="btn btn-primary">
                        <a href='controle_usuario.php' class="p-0 btn btn-primary">Exibir Todos</a>
                    </button>
                    <i class='fas fa-search' style='font-size: 28px; color: Dodgerblue;'></i>
                    <input type='text' id="pesquisaCliente" name="pesquisaCliente" Placeholder="Produto">
                    <i class='fas fa-search' style='font-size: 28px; color: Dodgerblue;'></i>
                    <input type='text' id="pesquisa" name="pesquisa" Placeholder="Categoria">
                </form> -->
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
    <?php //endif; 
    //include 'footer.php'; 
    ?>

    <?php //include 'funcoes/footer.php'; ?>
    <script type="text/javascript" src="js/custom.js"></script>

</body>

</html>