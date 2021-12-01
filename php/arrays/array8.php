<?php

require 'utils.php';

$idades['Fulano'] = 18;
$idades['Beltrano'] = 20;
$idades['Ciclano'] = 19;

//Vai dar erro
/*
for($i=0; $i<count($idades); $i++)
	\Util\mostralinha($idades[$i]);
*/

//Maneira correta de percorrer um array associativo
foreach($idades as $idade)
	\Util\mostralinha($idade);

?>
