<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Exemplo 1</title>
</head>

<body>

<?php


function soma1($a, $b) {

	$resultado = $a + $b;
	
	echo $resultado;
	
}

function soma($a, $b) {

	$resultado = $a + $b;
	
	//echo $resultado;
	
	return $resultado;

}

//echo soma(1, 2);

$resultado = soma(3,3);

$soma_x_5 = $resultado * 5;

//echo $resultado;

?>

</body>
</html>
