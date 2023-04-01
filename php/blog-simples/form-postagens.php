<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8" />
	<title>Formulário de criação de postagens</title>
</head>
<body>
	<h2>Criação de postagens</h2>

	<form action="insere-postagens.php" method="post"> <!-- Início do form -->
	
	
		<!-- Campo para entrada de texto -->
		<p>Título</p>
		<input type="text" name="titulo" /><br />
		
		<p>Texto</p>
		<textarea name="texto" rows="15" cols="20">
		Valor padrão</textarea>
		
		<p>Categoria</p>
		<select name="id_categoria">		
		<?php
		
		$grupo = 'blogs';
		$usuario = $grupo;
		$senha = $grupo;

		try {

			$pdo = new PDO('mysql:host=localhost;dbname=' . $grupo, $usuario, $senha);

			$stmt = $pdo->query("SELECT * FROM categorias");
			while ($row = $stmt->fetch()) {
				$nome_categoria = $row["nome"];
				$id_categoria = $row["id"];
				echo "<option value=$id_categoria>$nome_categoria</option>";
			}

			$pdo = null;
			
		} catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
			die();
		}

		?>


		<!-- Campo para botão de envio -->
		<input type="submit" value="Clique aqui para salvar" /> 
	
	</form> <!-- Fim do form -->
</body>
</html>
