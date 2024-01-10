<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8" />
	<title>Formulário de criação de usuários</title>
</head>
<body>
	<h2>Criação de usuários</h2>

	<form action="insere-usuario.php" method="post"> <!-- Início do form -->
	
	
		<!-- Campo para entrada de texto -->
		<p>E-mail</p>
		<input type="text" name="email" /><br />
		
		<p>Senha</p>
		<input type="password" name="password1" /><br />
		
		<p>Senha (confirme)</p>
		<input type="password" name="password2" /><br />

		<!-- Campo para botão de envio -->
		<input type="submit" value="Clique aqui para registrar" /> 
	
	</form> <!-- Fim do form -->
</body>
</html>
