
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Exemplo 12 - Namespaces</title>
</head>

<body>

<?php

$br = "<br />";

require('junta-inteiros2.php');

require('junta-strings2.php');


echo "Agora não deu erro: os namespace são diferentes." . $br;

echo "Juntando inteiros: " . \inteiros\mod1\junta(10,10) . $br;

echo "Juntando inteiros: " . \inteiros\mod2\junta(10,10) . $br;

echo "Juntando strings: " . \strings\junta('ba', 'nana') . $br;

?>



</body>
</html>
