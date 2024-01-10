<?php

session_start();

if ($_SESSION['user_id']) {
	
		$email = $_SESSION['email'];
		echo "Olá $email. Você pode:";
		echo "<a href='form-postagens.php'>Adicionar postagem</a> | ";
		echo "<a href='form-categorias.php'>Adicionar categoria</a> | ";
		echo "<a href='sair.php'>Sair do sistema</a>";

	}
else
	{
	
		echo "<a href='form-login.php'>Entrar</a> | ";
		echo "<a href='form-registrar.php'>Registrar</a>";
	
	}

?>
