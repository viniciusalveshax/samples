<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta  charset="utf-8" />
<title>Titulo</title>
</head>
<body>


<?php

// Código para fins educativos - Não use em produção

$id = $_GET['id'];

$conexao   = mysqli_connect("localhost", "phpmyadmin", "senha123", "pi2-testes");
//No Xampp
//$conexao   = mysqli_connect("localhost", "root", "", "BASE DE DADOS");

// A linha abaixo é suscetível à SQL Injection - não usar em produção
$resultado = mysqli_query($conexao, "SELECT * FROM usuarios WHERE id = " . $id);

echo "<h1>Read (leitura) </h1>";
while ($linha = mysqli_fetch_assoc($resultado)) {
	echo $linha['id'] . " " . $linha['nome'] . "<br />";
}

echo "<br /><a href=\"consulta-basica.php\">Voltar</a>";

//echo $linha['nome'];

?>

</body>
</html>

