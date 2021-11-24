<?php

function tabuada($numero) {

//$tab = array();

/*
for($i=1; $i<=10; $i++)
	$tab[$i] = $i * $numero;
*/
	
$i=1;
while($i<=10) {
	$tab[$i] = $i * $numero;
	$i++;
}	

return $tab;

}

$array_tabuada = tabuada(2);
print_r($array_tabuada);

/*
[0] = 2*1
[1] = 2*2
[...]
[9] = 2*9
*/

$a = 1;

echo $a ;

?>


muita dificuldade em achar os caracteres (? e /)
não sabe o que é o browser
não sabe fórmulas matemáticas básicas de geometria plana


