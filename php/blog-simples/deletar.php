
<?php

$tipo = $_POST["tipo"];
$id = $_POST["id"];

try {

	$grupo = "blogs";
	$usuario = $grupo;
	$senha = $grupo;
	$base_de_dados = $grupo;

	$pdo = new PDO('mysql:host=localhost;dbname=' . $base_de_dados, $usuario, $senha);

	$sql = "DELETE FROM $tipo WHERE id=?";
	$stmt= $pdo->prepare($sql);
	$stmt->execute([$id]);

	echo "<p>Uma das $tipo foi deletada com sucesso</p>";
	echo "<a href='admin.php'>Voltar para tela administrativa</a>";


	$pdo = null;
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
?>

