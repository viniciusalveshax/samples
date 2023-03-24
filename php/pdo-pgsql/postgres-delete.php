
<?php

try {
    $pdo = new PDO('pgsql:host=localhost;dbname=grupo00', "grupo00", "grupo00");

     $sql = "DELETE FROM teste WHERE campo1=?";
     $stmt= $pdo->prepare($sql);
     $stmt->execute([1]);

	echo "Deletado com sucesso";


    $dbh = null;
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
?>

