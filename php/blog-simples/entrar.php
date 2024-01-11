<?php

require "header.php";

$email = $_POST["email"];
$password = $_POST["password"];

// Testa se os campos email e senha foram preenchidos
if ($email && $password && ($email != "") && ($password != "")) {
	$erro = false;
}
else{
	$erro = true;
	$mensagem = "Você esqueceu de preencher algum campo";
}


if ($erro == false) {

	try {

		$grupo = "blogs";

		$usuario = $grupo;
		$senha = $grupo;
		$base_de_dados = $grupo;

		// Cria a conexão
		$pdo = new PDO('mysql:host=localhost;dbname=' . $grupo, $grupo, $grupo);

		// Força o PDO a gerar uma exceção em caso de erro - Mais fácil de diagnosticar erros
		$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

		// Procura o usuário no SGBD
		$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email=?");
		$stmt->execute([$email]); 
		$usuario = $stmt->fetch();

		// Pega a senha criptografada do banco de dados
		$hashed_password = $usuario["senha"];
		
		// Compara com a senha fornecida
		if (password_verify($password, $hashed_password)) {
			$erro = false;
			$mensagem = "Login realizado com sucesso";

			// Registra o id e o e-mail do usuário na sessão
			$_SESSION["user_id"] = $usuario["id"];
			$_SESSION["email"]   = $usuario["email"];

		}
		else {
			$erro = true;
			$mensagem = "Usuário e/ou senha não conferem";

		}
		
		 
		// Fecha a conexão
		$pdo = null;
		
	} catch (PDOException $e) {

		print "Error!: " . $e->getMessage() . "<br/>";
		die();
		
	}

}

echo "<p>$mensagem</p>";

// Verifica se aconteceu algum erro
if ($erro) {
	echo "<a href='form-login.php'>Voltar para tela de login</a>";
}
else
	echo "<a href='admin.php'>Voltar para a tela administrativa</a>";

?>
