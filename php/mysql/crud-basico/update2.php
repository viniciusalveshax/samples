<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta  charset="utf-8" />
<title>Titulo</title>
</head>
<body>


<?php

$id = $_POST["id"];
$nome= $_POST["nome"];

// Código para fins educativos - Não use em produção

$conexao   = mysqli_connect("localhost", "phpmyadmin", "senha123", "pi2-testes");
//No Xampp
//$conexao   = mysqli_connect("localhost", "root", "", "BASE DE DADOS");

if ($nome && ($nome != "") && $id && ($id != "")) {

	// A linha abaixo é suscetível à SQL Injection - não usar em produção
	
	$sql = "UPDATE usuarios SET nome = 	\"" . $nome . "\" WHERE id = " . $id;
	
	//echo $sql;
	$resultado = mysqli_query($conexao, $sql);

	echo "Registro atualizado com sucesso. <br />";


	}
else
	echo "Registro não foi atualizado. <br />";

// Mostra link de retorno
echo "<br /><a href=\"consulta-basica.php\">Voltar</a>";

?>

</body>
</html>

