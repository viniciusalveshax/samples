<?php

require "header.php";

$email = $_POST["email"];
$password = $_POST["password"];

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


		$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email=?");
		$stmt->execute([$email]); 
		$usuario = $stmt->fetch();

		$hashed_password = $usuario["senha"];
		
		if (password_verify($password, $hashed_password)) {
			$erro = false;
			$mensagem = "Login realizado com sucesso";
		}
		else {
			$erro = true;
			$mensagem = "Usuário e/ou senha não conferem";

		}
		

print_r($user);
/*
$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = '?'");
$stmt->execute([$email]);
var_dump($stmt);
while ($linha = $stmt->fetch()) {
	$email = $linha["email"];
	$hash = $linha["senha"];
	echo "<h2>$email</h2>";
	echo "<p>$hash</p>";
}

		if (password_verify($password, $hash)) {
			$erro = false;
			$mensagem = "Login realizado com sucesso";
		}
*/
		/*$count = $stmt->rowCount();
		echo "$email, $password, $count";


		if ($count == 1) {
			$erro = false;
			$mensagem = "Login realizado com sucesso";
			$linha = $stmt->fetch();
			$email = $linha['email'];
			$id    = $linha['id'];
			$_SESSION['user_id'] = $id;
			$_SESSION['email'] = $email;

		}
		else{
			$erro = true;
			$mensagem = "Não foi possível encontrar o seu usuário e/ou a senha está incorreta";
		}
		
		 
		// Fecha a conexão
		$pdo = null;
		*/
	} catch (PDOException $e) {

		print "Error!: " . $e->getMessage() . "<br/>";
		die();
		
	}

}

echo "<p>$mensagem</p>";

if ($erro) {
	echo "<a href='form-login.php'>Voltar para tela de login</a>";
}
else
	echo "<a href='admin.php'>Voltar para a tela administrativa</a>";

?>
