<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8" />
	<title>Página administrativa</title>
</head>
<body>
	<h2>Postagens</h2>


	<ul>
	<?php

		try {

			$grupo = "blogs";
			$usuario = $grupo;
			$senha = $grupo;

			$pdo = new PDO('mysql:host=localhost;dbname=' . $grupo, $usuario, $senha);

			//Seleciona as postagens e depois as mostra
			$stmt = $pdo->query("SELECT * FROM postagens");
			while ($row = $stmt->fetch()) {
				$nome = $row["titulo"];
				$id = $row["id"];
				$item = "<li value=$id>$nome";
				
				// Gera um formulário para deletar os itens. O campo hidden significa escondido e não aparece no navegador realmente
				$item = $item . "<form action='deletar.php' method='post'>";
				$item = $item . "<input type='hidden' name='id' value=$id />";
				$item = $item . "<input type='hidden' name='tipo' value='postagens' />";
				$item = $item . "<input type='submit' value='Deletar' /></form>";
				$item = $item . "</li>";
				echo $item;
			}

			$pdo = null;
			
		} catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
			die();
		}

	?>
		
	</ul>
	
	<a href="form-postagens.php">Adicionar postagem</a>

	<h2>Categorias</h2>

	<ul>
	
	<?php

		try {

			$grupo = "blogs";
			$usuario = $grupo;
			$senha = $grupo;

			$pdo = new PDO('mysql:host=localhost;dbname=' . $grupo, $usuario, $senha);

			// Seleciona as categorias para que elas sejam mostradas
			$stmt = $pdo->query("SELECT * FROM categorias");
			while ($row = $stmt->fetch()) {
				$nome = $row["nome"];
				$id = $row["id"];
				$item = "<li value=$id>$nome";
	
				// Gera um formulário para deletar os itens. O campo hidden significa escondido e não aparece no navegador realmente
				$item = $item . "<form action='deletar.php' method='post'>";
				$item = $item . "<input type='hidden' name='id' value=$id />";
				$item = $item . "<input type='hidden' name='tipo' value='categorias' />";
				$item = $item . "<input type='submit' value='Deletar' /></form>";
				$item = $item . "</li>";
				echo $item;
			}

			$pdo = null;
			
		} catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
			die();
		}

	?>
	
	
	
	</ul>
	
	<a href="form-categorias.php">Adicionar categoria</a>
	
</body>
</html>
