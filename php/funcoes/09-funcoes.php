<?php

declare(strict_types=1);


?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Exemplo 1</title>
</head>

<body>

<?php




function maior_que_dez(int $numero): int {

	if ($numero > 10)
		return $numero;
	else	
		return 'a';
		
	echo "Olá";

}

echo maior_que_dez(11);
//echo maior_que_dez(9);

?>

</body>
</html>
