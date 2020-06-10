<?php
date_default_timezone_set('America/Sao_Paulo');

/* Inicia a sessão */
session_start(); 
require 'init.php';
require 'conexao.php';
include 'menunavbar.php';
session_checker();

$log=isLoggedIn();
$HoraAgora=date('H:i:s');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rádio Táxi Azul e Branco</title>
    <meta name="description" content="Táxi Guarucoop - Rádio Táxi credenciada no Aeropoto Internacional de Guarulhos - SP / Brasil">
    <meta name="keywords" content="Rádio Táxi Azul e Branco - Guarucoop - GRU Airport"> 
    <title>Guinchos</title>
    
    <!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">  -->
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/custom.css">      
   <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
   <script src="https://kit.fontawesome.com/712f8f6219.js" crossorigin="anonymous"></script>
    <script type="text/javascript">
    $(document).ready(function(){
 
    function loading_show(){
        $('#loading').html("<i class='fas fa-hourglass-start' style='font-size: 28px; color: Dodgerblue;'></i>").fadeIn('fast');
    }
     
    //Aqui desativa a imagem de loading
    function loading_hide(){
        $('#loading').fadeOut('fast');
    }     
     
     
    // aqui a função ajax que busca os dados em outra pagina do tipo html, não é json
    function load_dados(valores, page, div)
    {
        $.ajax
            ({
                type: 'POST',
                dataType: 'html',
                url: page,
                beforeSend: function(){//Chama o loading antes do carregamento
                      loading_show();
                },
                data: valores,
                success: function(msg)
                {
                    loading_hide();
                    var data = msg;
                    $(div).html(data).fadeIn();             
                }
            });
    }
     
    //Aqui eu chamo o metodo de load pela primeira vez sem parametros para pode exibir todos
    load_dados(null, 'pesquisa.php', '#MostraPesq');
     
     
    //Aqui uso o evento key up para começar a pesquisar, se valor for maior q 0 ele faz a pesquisa
    $('#pesquisaCliente').keyup(function(){
         
        var valores = $('#form_pesquisa').serialize()//o serialize retorna uma string pronta para ser enviada
         
        //pegando o valor do campo #pesquisaCliente
        var $parametro = $(this).val();
         
        if($parametro.length >= 1)
        {
            load_dados(valores, 'pesquisa.php', '#MostraPesq');
        }else
        {
            load_dados(null, 'pesquisa.php', '#MostraPesq');
        }
    });
 
    });
    </script>
</head>
<body>
    <?php $log=isLoggedIn(); 
        if ($log=='1'):
            
    ?>
    
    
   
<div class="container">
               
        <h2 class="bg-light text-primary text-center"><b>Controle de Usuários - Acesso WebTáxi</b></h2>         
        <hr class="btn-warning" />
        
    </div>
    
<div class="container">
            <form action="pesquisa.php" method="post" name="form_pesquisa" id="form_pesquisa">
                <a href='cadastro_usuario.php' class="btn btn-success">Criar Novo Usuário</a>
                <button type="button" class="btn btn-primary">
                    <a href='controle_usuario.php' class="p-0 btn btn-primary">Exibir Todos</a>               
                </button>
                <i class='fas fa-search' style='font-size: 28px; color: Dodgerblue;'></i>
                <input type='text' id="pesquisaCliente" name="pesquisaCliente" Placeholder="Procurar Usuário">               
            </form>
            <hr class="btn-warning" />
            <div id="contentLoading">
                <div id="loading"></div>
            </div>
            <section class="jumbotron">
                <div id="MostraPesq"></div>
            </section>
       
</div>
<?php endif; 
include 'footer.php'; ?>
    <script type="text/javascript" src="js/custom.js"></script>
</body>
</html>