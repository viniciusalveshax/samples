<?php

if ($_SESSION["user_id"]) {
	unset($_SESSION["user_id"]);
	unset($_SESSION["email"]);
	}

echo "<p><a href='form-login.php'>Voltar para tela de login</a></p>";
echo "<p><a href='index.php'>Voltar para tela inicial</a></p>";

?>
