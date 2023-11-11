def soma3(a, b=1):
	resultado = a + b
	print("Resultado de a (", a, ")+b(", b, ")=",resultado, sep='')

# A única diferença entre soma3 e soma4 é o valor opcional para b
def soma4(a, b):
	resultado = a + b
	print("Resultado de a (", a, ")+b(", b, ")=",resultado, sep='')

print("Se eu passar dois parâmetros a soma ocorre normalmente")
soma3(20, 30)

print("Se eu passar somente um parâmetro ele vai ser o a e o outro vai ter valor = 1")
soma3(20)

print("soma4 requer dois parâmetros")
soma4(100,100)

print("Como soma4 não está configurada para aceitar um dos parâmetros como opcional, se eu passar um único parâmetro resultará em um erro. Descomente a linha abaixo para ver um erro acontecer")
#soma4(10)
