<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta  charset="utf-8" />
<title>Titulo</title>
</head>
<body>


<?php

// Substitua pelos valores do host, usuário, senha e base de dados respectivamente
$conexao   = mysqli_connect("localhost", "phpmyadmin", "senha123", "pi2-testes");

// Substitua pela tabela correta
$resultado = mysqli_query($conexao, "SELECT * FROM usuarios");

while ($linha = mysqli_fetch_assoc($resultado)) {

	// Substitua pelo campo correto
	echo $linha['nome'] . "<br />";
}

?>


</body>
</html>

