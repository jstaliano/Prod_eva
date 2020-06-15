<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
	  <meta name="description" content="">
	  <link rel="icon" href="img/start.ico">
  	<meta name="keywords" content="">	
	<title>Produtos</title>
	
  	
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>
<?php

session_start();

if(!isset($_REQUEST['logmeout'])){ ?>
	<div class='container text-center'>
		<?php
		echo "<h3>Voc&ecirc; realmente deseja sair da &aacute;rea restrita?<br />";		
		echo "<a href=\"logout.php?logmeout\" class='btn btn-success'>Sim</H3></a> | <a href=\"javascript:history.go(-1)\" class='btn btn-danger'>N&atilde;o</a>";
		echo "</h3>";
		?>
	</div>
<?php
}
else{
	session_destroy();
	echo "<div class='alert alert-danger text-center' role='alert'><h3>Sessão Encerrada ...</h3></div> ";
	echo "<meta http-equiv=refresh content='2;URL=index.php'>";	
}
?>

	<script type="text/javascript" src="js/custom.js"></script>
</body>
</html>