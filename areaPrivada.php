<?php
 session_start();
 if(!isset($_SESSION['id_atendente'])){ // verifica se o usuario logou para poder acessar a areaPrivada
 	header("location: index.php");
 	exit;
 }
?>

<h1>FUNFO GARAI, TUDO Okà</h1>
<a href="SAIR.php">Sair</a>