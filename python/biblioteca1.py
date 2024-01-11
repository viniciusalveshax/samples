# -*- coding: utf-8 -*-

meses = {"Jan": 31, "Fev": 28, "Mar": 31,
	 "Abr": 30, "Mai": 31, "Jun": 30,
	 "Jul": 30, "Ago": 31, "Set": 30,
	 "Out": 31, "Nov": 30, "Dez": 31}
# Transforma o dicionário acima em uma lista contendo só os dias de cada mês
# A lista começa em 0
lista_meses = list(meses.values())
	

#Esse laço tenta garantir que o usuário digite três partes
hoje = []
tamanho_data = 0
while tamanho_data != 3:
	data_str = input("Digite a data de hoje no formato DIA/MES/ANO ")
	hoje = data_str.split("/")
	print(hoje)
	tamanho_data = len(hoje)
	
# Converte dia do mês pra inteiro para usar depois
dia = int(hoje[0])
# Converte mês pra inteiro para usar depois
mes = int(hoje[1])

dias_livro = input("Digite quantos dias vocês está com o livro ")
dias_livro = int(dias_livro)

#Testa se já está com os livros há mais de um mês (considerando fevereiro)
if dias_livro > 28:
	print("Puxa ... você vai pagar uma bela multa ... melhor devolver o quanto antes")
else:
	# Calcula quantos dias ainda pode ficar com o livro
	# Considerando devolução após uma semana
	quantos_dias_pode_ficar = 7 - dias_livro
	
	# Se os dias que podem ficar deu negativo então tem que devolver hoje
	if quantos_dias_pode_ficar <= 0:
		print("Melhor devolver hoje")
	else:
	
		# Calcula qual dia do mês vai precisar devolver o livro
		dia_dev = quantos_dias_pode_ficar + dia
		mes_dev = mes
		if dia_dev > lista_meses[mes-1]:
			# Se o número de dias ultrapassa os dias do mês então
			# tem que devolver no próximo mês
			mes_dev = mes_dev + 1
			# Calcula o dia do próximo mês
			# Diminui do tamanho do mês porque passa pro mês seguinte
			dia_dev = dia_dev - lista_meses[mes-1]
		print("Devolva no dia ", dia_dev, " do mês ", mes_dev)
