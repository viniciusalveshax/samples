<?php

// Inicia uma sessão
session_start();

// Testa se a variável user_id existe na sessão
if ($_SESSION['user_id']) {
	
		//Se existir mostra o e-mail e links administrativos
		$email = $_SESSION['email'];
		echo "Olá $email. Você pode:";
		echo "<a href='form-postagens.php'>Adicionar postagem</a> | ";
		echo "<a href='form-categorias.php'>Adicionar categoria</a> | ";
		echo "<a href='sair.php'>Sair do sistema</a>";

	}
else
	{
		//Se a sessão não existir dá a opção ao usuário de entrar no sistema ou fazer o registro
		echo "<a href='form-login.php'>Entrar</a> | ";
		echo "<a href='form-registrar.php'>Registrar</a>";
	
	}

?>
