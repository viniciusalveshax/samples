
<?php

//Código baseado em https://www.php.net/manual/pt_BR/features.file-upload.post-method.php

$uploaddir = '/var/www/html/exemplos-php/file_uploads/';
$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
$separator = "/";

if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
    echo "Arquivo válido e enviado com sucesso.\n";
} else {
    echo "Erro no upload de arquivo!\n";
}

echo 'Aqui está mais informações de debug:';
print_r($_FILES);


//echo $_FILES['userfile']['name'];
echo "<br /><img src=\"file_uploads" . $separator . $_FILES['userfile']['name'] . "\" />";

?>

