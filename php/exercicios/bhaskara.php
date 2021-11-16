<?php

function delta($a, $b, $c) {

	$delta = ($b * $b) - ( 4 * $a * $c );
	
	return $delta;

}

function bhaskara($a, $b, $c){

	$delta = delta($a, $b, $c);

	$num_pos = -$b + sqrt($delta);
	$num_neg = -$b - sqrt($delta);
	$den     = 2*$a; 

	$raiz1 = $num_pos / $den;
	
	$raiz2 = $num_neg / $den;
	
	echo "Raiz1: ${raiz1}, raiz2: ${raiz2}";
}


bhaskara(2, -6, 0);

?>
