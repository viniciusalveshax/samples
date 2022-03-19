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

// Pega linha do resultado
$linha = mysqli_fetch_assoc($resultado);

?>

<form action="update2.php" method="post">

<input type="hidden" name="id" value="<?php echo $linha["id"]; ?>"/>

<p>Digite o nome</p>
<input type="text" name="nome" value="<?php echo $linha["nome"]; ?>"/>

<p>
<input type="submit" value="Atualizar" />
</p>

</form>

<a href="consulta-basica.php">Voltar</a>


</body>
</html>

