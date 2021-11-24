<?php

$array1 = array(1,2,3);
$array2 = array(4,5,6);
$array3 = array(7,8,9);

$array_de_arrays = array($array1, $array2, $array3);

foreach($array_de_arrays as $array)
	foreach($array as $elemento)
		echo $elemento . ',';

?>
