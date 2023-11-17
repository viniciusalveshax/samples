# Função que mostra todos os números divisíveis por 3 e 5
# dentro do intervalo que vai de começo até fim
def divisiveis(comeco, fim):
	# Range retorna o intervalo comecando em comeco e para antes de fim
	# Por isso se quisermos incluir o fim na listagem devemos chamar
	# range(comeco, fim+1)
	for numero in range(comeco, fim+1):
		# % é o operador de resto da divisão
		# então 10 % 3 retorna o resto da divisão de 10 por 3
		# que, nesse exemplo, seria 1
		# se o resto da divisão for zero isso significa que
		# temos uma divisão exata, ou seja, o número é divisível
		resto_3 = numero % 3
		resto_5 = numero % 5
		# Se o resto_3 E o resto_5 forem ambos zero
		# isso significa que o número é divisível por ambos
		# e deve ser mostrado
		if resto_3 == 0 and resto_5 == 0:
			print(numero)


divisiveis(20, 40)
