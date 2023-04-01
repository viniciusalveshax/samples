<?php

$nome = $_POST["nome"];

$grupo = "blogs";

try {

	$usuario = $grupo;
	$senha = $grupo;
	$base_de_dados = $grupo;

	$pdo = new PDO('mysql:host=localhost;dbname=' . $base_de_dados, $usuario, $senha);

	// Prepara o SQL que será inserido
	$sql = "INSERT INTO categorias (nome) VALUES (?)";
	$stmt= $pdo->prepare($sql);
	
	// Executa o SQL substituindo cada uma das variáveis pelos pontos de interrogação
	$stmt->execute([$nome]);

	// Se deu tudo certo mostra a mensagem
	echo "<p>Inseriu com sucesso</p>";
	echo "<a href='admin.php'>Voltar para tela administrativa</a>";

	// Fecha a conexão
	$pdo = null;
	
} catch (PDOException $e) {

	print "Erro: " . $e->getMessage() . "<br/>";
	die();
	
}

?>
