<?php

require 'utils.php';

$nomes[0] = "Fulano";
$nomes[1] = "Beltrano";
$nomes[2] = "Ciclano";
$nomes[3] = "Luke";
$nomes[4] = "Léia";

$conta_nomes = count($nomes);

for($i=0; $i<count($nomes); $i++)
	\Util\mostralinha($nomes[$i]);

?>
