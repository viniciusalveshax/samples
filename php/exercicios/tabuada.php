<?php

function tabuada($numero) {

$tabuada = array();

for($i=1; $i<=10; $i++)
	$tabuada[$i] = $numero * $i;

return $tabuada;

}

print_r(tabuada(2));

?>



