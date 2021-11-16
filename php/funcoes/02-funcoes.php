<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Exemplo 1</title>
</head>

<body>

<?php

function mostra_paragrafo($conteudo) {

$abre_p  = "<p>";
$fecha_p = "</p>";

echo $abre_p . $conteudo . $fecha_p;

}

mostra_paragrafo("Parágrafo 1");
mostra_paragrafo("Parágrafo 2");

?>

</body>
</html>
