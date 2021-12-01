<?php

require 'utils.php';

$idades['Fulano'] = 18;
$idades['Beltrano'] = 20;
$idades['Ciclano'] = 19;

$conta_idades = count($idades);

foreach($idades as $idade)
	\Util\mostralinha($idade);
	
echo "<hr />";

foreach($idades as $chave => $valor)
	\Util\mostralinha($chave . ':' . $valor);	

?>
