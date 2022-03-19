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
$resultado = mysqli_query($conexao, "SELECT * FROM usuarios WHERE id = " . $id);

echo "<h1>Read (leitura) </h1>";
// Pega linha do resultado
$linha = mysqli_fetch_assoc($resultado);

// Mostra valor da linha
echo $linha['id'] . " " . $linha['nome'] . "<br />";

// Mostra link de retorno
echo "<br /><a href=\"consulta-basica.php\">Voltar</a>";

?>

</body>
</html>

