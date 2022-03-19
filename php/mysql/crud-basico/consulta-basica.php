<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta  charset="utf-8" />
<title>Titulo</title>
</head>
<body>


<?php


$conexao   = mysqli_connect("localhost", "phpmyadmin", "senha123", "pi2-testes");
//No Xampp
//$conexao   = mysqli_connect("localhost", "root", "", "BASE DE DADOS");

$resultado = mysqli_query($conexao, "SELECT * FROM usuarios");

echo "<h1>Resultados </h1>";
while ($linha = mysqli_fetch_assoc($resultado)) {
	echo $linha['id'] . " " . $linha['nome'] .
	"<a href='read.php?id=" . $linha['id'] . "'>READ</a>" .
	"<a href=\"update.php?id=" . $linha['id'] . "\">UPDATE</a>" .
	"<a href='delete.php?id=" . $linha['id'] . "'>DELETE</a> <br />";
}

echo "<br /><a href=\"create.html\">CREATE</a>";

//echo $linha['nome'];

?>

</body>
</html>

