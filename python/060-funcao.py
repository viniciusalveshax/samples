def soma1(a, b):
	resultado = a + b
	print("Resultado ", resultado)

def soma2(a, b):
	resultado = a + b
	return resultado

print("A função soma1 mostra o resultado mas não retorna nada. Não é possível reutilizar o resultado")
soma1(20, 30)

print("A função soma2 não mostra nada mas retorna o resultado. Eu consigo reutilizar o resultado, se necessário")
result = soma1(20, 30)
# Se eu quiser posso mostrar o valor de result
