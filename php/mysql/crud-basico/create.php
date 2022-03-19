<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta  charset="utf-8" />
<title>Titulo</title>
</head>
<body>


<?php

// Código para fins educativos - Não use em produção

$conexao   = mysqli_connect("localhost", "phpmyadmin", "senha123", "pi2-testes");
//No Xampp
//$conexao   = mysqli_connect("localhost", "root", "", "BASE DE DADOS");

$nome = $_POST["nome"];
if ($nome && ($nome != "")) {

	// A linha abaixo é suscetível à SQL Injection - não usar em produção
	$resultado = mysqli_query($conexao, "INSERT INTO usuarios (nome) VALUES (\"" . $nome . "\")");

	echo "Registro criado com sucesso. <br />";


	}
else
	echo "Registro não foi criado. <br />";

// Mostra link de retorno
echo "<br /><a href=\"consulta-basica.php\">Voltar</a>";

?>

</body>
</html>

