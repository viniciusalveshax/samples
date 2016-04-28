#!/usr/bin/perl

# Ola mundo!
print "Ola mundo!\n";

# Comparações verdadeiras mostram 1 na tela
print "Dois é igual a dois? ", 2 == 2, "\n";
print "Um é igual a dois? ", 1 == 2, "\n";

# Operações com strings
# . é a operação de concatenação
print "Uma " . "unica " . "frase!\n";
# x é a operação de repetição
# o comando abaixo repete 'na' duas vezes
# para três vezes seria só trocar por x3 e assim por diante
print "Ba" . "na"x2 . "\n";

# Conversão de strings para números
print "1 exemplo" + 0, "\n";
print "Quando não há números, a string é convertida para zero" + 0, "\n";

# Variaveis comuns começam com $ em Perl
# Arrays são precedidos por um @ e Hashs por um sinal de %
$var = 1;
print $var, "\n";

# Escopo em Perl
# Por padrão as variáveis são globais em Perl. Para declarar variáveis locais usamos a palavra 'my' antes da declaração
my $number = 1;
print $number, "\n";

# Para ler o teclado usamos a construção <STDIN>
print "Digite um comentário:\n";
my $comment = <STDIN>;
print $comment;

# Listas em perl começam com @. Indices começam em zero.
# Notem entretanto que quando queremos obter um elemento de uma
# lista devemos usar o $ e não @, pois usando o @ estaremos obtendo uma lista e não uma variável simples
my @list = (1, 2, 3);
print $list[0];

