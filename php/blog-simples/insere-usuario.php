<?php

$email = $_POST["email"];
$password1 = $_POST["password1"];
$password2 = $_POST["password2"];

$erro = false;

if ($email && $password1 && $password2 && ($email != "") && ($password1 != "") && ($password2 != "")){
	if ($password1 != $password2) {
		$erro = true;
		$mensagem = "As senhas são diferentes";
	}
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

		// Prepara o SQL que será inserido
		$sql = "INSERT INTO usuarios (email, senha) VALUES (?, ?)";
		$stmt= $pdo->prepare($sql);
		
		// Não devemos salvar a senha com seu valor normal no SGBD pois isso expõe a senha do usuário, então codificamos ela antes
		// Não resolve todos os problemas mas já é alguma coisa
		$password1 = password_hash("password1", PASSWORD_DEFAULT);
		
		// Executa o SQL substituindo cada uma das variáveis pelos pontos de interrogação
		$stmt->execute([$email, $password1]);

		// Se deu tudo certo mostra a mensagem
		echo "<p>Usuário cadastrado com sucesso</p>";
		echo "<p><a href='form-login.php'>Clique aqui para fazer login</a></p>";
		echo "<p><a href='index.php'>Clique aqui para voltar para a tela inicial</a></p>";

		// Fecha a conexão
		$pdo = null;
		
	} catch (PDOException $e) {

		print "Error!: " . $e->getMessage() . "<br/>";
		die();
		
	}

}

else {

	echo "<p>$mensagem</p>";
	echo "<a href='form-registrar.php'>Voltar para tela de registro</a>";

}

?>
