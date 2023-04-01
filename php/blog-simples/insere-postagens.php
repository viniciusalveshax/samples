<?php

$titulo = $_POST["titulo"];
$texto = $_POST["texto"];
$id_categoria = $_POST["id_categoria"];

$grupo = "blogs";

try {

	$usuario = $grupo;
	$senha = $grupo;
	$base_de_dados = $grupo;

	$pdo = new PDO('mysql:host=localhost;dbname=' . $grupo, $grupo, $grupo);

	// Prepara o SQL que será inserido
	$sql = "INSERT INTO postagens (titulo, texto, id_categoria) VALUES (?, ?, ?)";
	$stmt= $pdo->prepare($sql);
	
	// Executa o SQL substituindo cada uma das variáveis pelos pontos de interrogação
	$stmt->execute([$titulo, $texto, $id_categoria]);

	// Se deu tudo certo mostra a mensagem
	echo "<p>Inseriu com sucesso</p>";
	echo "<a href='admin.php'>Voltar para tela administrativa</a>";

	// Fecha a conexão
	$pdo = null;
	
} catch (PDOException $e) {

	print "Error!: " . $e->getMessage() . "<br/>";
	die();
	
}

?>
