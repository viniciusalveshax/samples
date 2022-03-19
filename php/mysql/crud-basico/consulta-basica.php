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
	" <a href='read.php?id=" . $linha['id'] . "'>READ</a>" .
	" <a href=\"\">UPDATE</a> <a href=''>DELETE</a> <br />";
}

echo "<br /><a href=\"\">CREATE</a>";

//echo $linha['nome'];

?>

</body>
</html>

