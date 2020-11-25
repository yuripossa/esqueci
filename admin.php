<!DOCTYPE html>
<html>

<head>
	<?php
	session_start();
	if ((!isset($_SESSION['login']) == true) and (!isset($_SESSION['senha']) == true)) {
		unset($_SESSION['login']);
		unset($_SESSION['senha']);
		header('location:login.php');
	}
	$login = $_SESSION['login'];
	$senha = $_SESSION['senha'];
	$id;
	include 'bd/conexao.php';
	$pdo = Banco::conectar();
	$sql = "SELECT * FROM usuario WHERE email='$login' AND senha='$senha'";
	foreach ($pdo->query($sql) as $row) {
		$cargo = $row['cargo'];
	}
	if ($cargo != "Administrador") {
		unset($_SESSION['login']);
		unset($_SESSION['senha']);
		header('location:login.php');
	}
	$logado = $_SESSION['login'];
	?>
	<meta charset="utf-8">
	<title>Tipo de navegação</title>
	<link rel="stylesheet" href="css/inicio.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<style>
		.botaoL {
			width: 120px;
			float: left;
			position: relative;
		}

		.botaoR {
			width: 120px;
			float: right;
			position: relative;
		}
	</style>
</head>

<body>
	<div class="box">
		<h2> O que você deseja? </h2>
		<a href="dispensa.php" class="btn btn-primary botaoL" style="a:link; color:white; text-decoration:none; " target="_blank">Site</a>
		<a href="crudIngredientes.php" class="btn btn-primary botaoR" style="a:link; color:white; text-decoration:none;" target="_blank">CRUD's</a>
	</div>
</body>

</html>