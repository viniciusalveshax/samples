<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8" />
	<title>Upload de arquivos</title>
</head>
<body>

<!-- código do formulário baseado em https://www.php.net/manual/pt_BR/features.file-upload.post-method.php -->

<form enctype="multipart/form-data" action="13-upload2.php" method="POST">
    <!-- MAX_FILE_SIZE deve preceder o campo input -->
    <input type="hidden" name="MAX_FILE_SIZE" value="300000" /> 
    <!-- O Nome do elemento input determina o nome da array $_FILES -->
    Enviar esse arquivo: <input name="userfile" type="file" /> <br />
    <input type="submit" value="Enviar arquivo" />
</form>

</body>
</html>
