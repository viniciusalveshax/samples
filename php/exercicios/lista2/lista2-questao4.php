<?php

$arr = array(-1 => 3.9, 0 => 3.14, 10 => 8.9, 9 => 20.0, 15 => 21.3, 40 => 49.1);

foreach($arr as $chave => $valor) {
	if ($chave > 10)
		echo "<br>$valor";
}

$chaves = array_keys($arr);

foreach($chaves as $chave) {
		if ($chave > 10) {
			echo "<br>$arr[$chave]";
			echo "<br>" . $arr[$chave];
		}

		
	}


?>
