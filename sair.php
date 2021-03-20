<?php
	session_start();
	unset($_SESSION['id_atendente']); // destroi a sessao atual. Assim n sera possivel acessar, apenas logando novamente
	header("location: index.php");
?>