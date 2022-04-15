# Exemplo 031 que exemplo o uso de if, elif e else em Python
# Código que diz se dois números são pares, se é um é par ou se nenhum é par

numero1 = 9
numero2 = 11
if (numero1%2)==0 and (numero2%2)==0:
	print("Ambos são par")
elif (numero1%2)==0:
	print("Numero 1 é par")
elif (numero2%2)==0:
	print("Número 2 é par")
else:
	print("Ambos os números são ímpar")
