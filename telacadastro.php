<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Cadastre-se</title>
	<link rel="stylesheet" href="css/inicio.css">
	<!-- Bootstrap CSS -->
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
		<?php 		?>
		<h2> Cadastro</h2>
		<?php

		include 'bd/conexao.php';
		$pdo = Banco::conectar();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$nome = '';
		$email = '';
		$senha = '';
		$cor = '';
		if (!empty($_POST['nome'])) {
			$nome = $_POST['nome'];
			$email = $_POST['email'];
			$senha = $_POST['senha'];
			//Verificar se o email ja existe
			$sql = "SELECT * FROM usuario WHERE email='$email'";
			//Contador para verificação
			$i = 0;
			foreach ($pdo->query($sql) as $row) {
				$i++;
			}
			//Caso i seja igual a 0, quer dizer que não tem email igual.
			if ($i == 0) {
				$sql = "INSERT INTO usuario (nome, email, senha,cargo) VALUES(?,?,?,'Simples')";
				$q = $pdo->prepare($sql);
				$q->execute(array($nome, $email, $senha));
				$nome = '';
				$email = '';
				$senha = '';
				header('Location:login.php');
			} else {
				echo "<div class='alert alert-danger' role='alert'>
						Email já cadastrado D=
					  </div>";
				$cor = 'red';
			}
		}
		echo '<form method="post" name="formCadastrado" action="#">
			<div class="inputBox">
				<input type="text" name="nome" required value=' . $nome . '>
				<label>Usuario</label>
			</div>
			<div class="inputBox">
				<input style="color:' . $cor . '" type="email" name="email" required value=' . $email . '>
				<label>Email</label>
			</div>
			<div class="inputBox">
				<input type="password" name="senha" required value=' . $senha . '>
				<label>Senha</label>
			</div>
			<button class="btn btn-primary botaoL" type="submit" value="Entrar">Cadastrar</button>
		</form>
		
		<a  class="btn btn-success botaoR" href="login.php" style="a:link; color:white; text-decoration:none;">Entrar</a>
	</div>';
		Banco::desconectar();
		?>
</body>

</html>