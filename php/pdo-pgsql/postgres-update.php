
<?php

try {
    $pdo = new PDO('pgsql:host=localhost;dbname=grupo00', "grupo00", "grupo00");

	$sql = "UPDATE teste SET campo2=? WHERE campo1=?";
	$stmt= $pdo->prepare($sql);
	$stmt->execute(["String2", 1]);


    $dbh = null;
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
?>

