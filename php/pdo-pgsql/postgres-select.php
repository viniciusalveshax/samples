
<?php

try {
    $pdo = new PDO('pgsql:host=localhost;dbname=grupo00', "grupo00", "grupo00");

$stmt = $pdo->query("SELECT * FROM teste");
while ($row = $stmt->fetch()) {
    echo $row["campo2"]."<br />\n";
}

    $dbh = null;
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
?>

