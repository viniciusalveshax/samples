<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta  charset="utf-8" />
<title>Titulo</title>
</head>
<body>


<?php

// Código para fins educativos - Não use em produção

// Pega o id passado por GET
$id = $_GET['id'];

$conexao   = mysqli_connect("localhost", "phpmyadmin", "senha123", "pi2-testes");
//No Xampp
//$conexao   = mysqli_connect("localhost", "root", "", "BASE DE DADOS");

// A linha abaixo é suscetível à SQL Injection - não usar em produção
$resultado = mysqli_query($conexao, "DELETE FROM usuarios WHERE id = " . $id);

echo "<h1>DELETE </h1>";

$linhas_alteradas = mysqli_affected_rows($conexao);
//print_r($resultado);

if ($linhas_alteradas == 1)
	echo "Registro deletado com sucesso. <br />";
else
	echo "Registro não foi deletado. <br />";

// Mostra link de retorno
echo "<br /><a href=\"consulta-basica.php\">Voltar</a>";

?>

</body>
</html>

