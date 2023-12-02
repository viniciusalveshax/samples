<?php

$numero1 = 22;
$numero2 = 25;

if ($numero1>$numero2)
	echo "O primeiro número deve ser menor ou igual do que o segundo";
else
	//Programa 'de verdade' começa aqui

	for($k=$numero1;$k<=$numero2; $k++) {
		echo "<br> $k\$ \\\\ ";
	}

?>
