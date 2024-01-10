<?php

require "header.php";

$grupo = "blogs";
$usuario = $grupo;
$senha = $grupo;
$base_de_dados = $grupo;

echo "<h1>Postagens</h1>";

$pdo = new PDO('mysql:host=localhost;dbname=' . $grupo, $grupo, $grupo);


$stmt = $pdo->query("SELECT * FROM postagens");
while ($linha = $stmt->fetch()) {
	$titulo = $linha["titulo"];
	$texto = $linha["texto"];
	echo "<h2>$titulo</h2>";
	echo "<p>$texto</p>";
}

// Fecha a conexão
$pdo = null;
	

?>
