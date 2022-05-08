
<?php

//Código baseado em https://www.php.net/manual/pt_BR/features.file-upload.post-method.php


//Verifica alguns erros do upload
if (is_uploaded_file($_FILES['userfile']['tmp_name']) {
 
	$uploaddir = '/var/www/html/exemplos-php/file_uploads/';
	$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

	if (preg_match('/[^a-z0-9.#$-]/i', $_FILES['userfile']['name']))
		exit("Invalid characters found");
	
	if (mb_strlen($_FILES['userfile']['name'],"UTF-8") > 225) {
		exit("Tamanho do nome de arquivo muito grande");
	}
	
	if(!preg_match("/\\.(gif|jpg|jpeg|png|bmp)$/i", $_FILES['userfile']['name'])){
		exit("You cannot upload this type of file.");
	}

	if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
		echo "Arquivo válido e enviado com sucesso.\n";
	} else {
		echo "Erro no upload de arquivo!\n";
	}

	//echo $_FILES['userfile']['name'];
	echo "<br /><img src=\"file_uploads/" . $_FILES['userfile']['name'] . "\" />";
 
} else {
	switch($_FILES['userfile']['error']){
		case 1: //uploaded file exceeds the upload_max_filesize directive in php.ini
		echo "The file you are trying to upload is too big.";
		break;
		case 2: //uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the html form
		echo "The file you are trying to upload is too big.";
		break;
		case 3: //uploaded file was only partially uploaded
		echo "The file you are trying upload was only partially uploaded.";
		break;
		case 4: //no file was uploaded
		echo "You must select an image for upload.";
		break;
		default: //a default error, just in case!  :)
		echo "There was a problem with your upload.";
		break;
	}
}


echo 'Aqui está mais informações de debug:';
print_r($_FILES);

?>

