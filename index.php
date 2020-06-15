<?php
date_default_timezone_set('America/Sao_Paulo');

/* Inicia a sessão */
session_start(); 
require_once './funcoes/init.php';
require_once './funcoes/conexao.php';
//include 'menunavbar.php';/
session_checker();
//include 'menumenu.php'; 
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/712f8f6219.js" crossorigin="anonymous"></script>
    </head>

<body>
    <?php $log=isLoggedIn(); 
    if ($log=='1'):

        include 'funcoes/mainheader.php';
        include 'funcoes/footer.php'; 
    endif;

    ?>
    <script type="text/javascript" src="js/custom.js"></script>
</body>
</html>