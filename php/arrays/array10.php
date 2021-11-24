<?php

require 'utils.php';

$nomes[0] = "Fulano";
$nomes[1] = "Beltrano";
$nomes[2] = "Ciclano";
$nomes[3] = "Luke";
$nomes[4] = "Léia";

foreach($nomes as $nome)
	\Util\mostralinha($nome);
	
echo "<hr />";

foreach($nomes as $chave => $valor)
	\Util\mostralinha($chave . ':' . $valor);	

?>
