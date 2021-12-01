<?php

require 'utils.php';

$nomes[0] = "Fulano";
$nomes[1] = "Beltrano";
$nomes[2] = "Ciclano";
$nomes[3] = "Luke";
$nomes[4] = "Léia";

$conta_nomes = count($nomes);
echo $conta_nomes;

echo "<hr />";

$idades['Fulano'] = 18;
$idades['Beltrano'] = 20;
$idades['Ciclano'] = 19;

echo count($idades);

?>
