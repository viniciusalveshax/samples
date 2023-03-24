
<?php


try {

	$usuario = 'grupo00';
	$senha = 'grupo00';

    $pdo = new PDO('pgsql:host=localhost;dbname=grupo00', $usuario, $senha);

      $sql = "INSERT INTO teste (campo1, campo2) VALUES (?,?)";
      $stmt= $pdo->prepare($sql);
      $stmt->execute([1, "String1"]);

	echo "Inseriu com sucesso";

    $dbh = null;
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
?>

