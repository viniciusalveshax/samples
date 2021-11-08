<?php

$br = "<br />";

$i = 10;

echo "While" . $br;

while($i != 0) {
	echo $i . $br;
	$i = $i - 1;
}

echo "Do-while" . $br;

do {

	echo $i . $br;
	$i = $i + 1;

} while ($i < 10);

?>
