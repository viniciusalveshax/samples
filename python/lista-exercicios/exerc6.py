import math
numeros = []
total = 0
while(True):
    string = input("Digite um numero")
    novonumero = float(string)
    if (novonumero < 0):
        break
    else:
        total = total + novonumero
        numeros.append(novonumero) 
tamanholista = len(numeros)
media = total / tamanholista
numerador = 0
for numero in numeros:
    numerador=numerador+(numero-media)*(numero-media)
desvio = math.sqrt(numerador/tamanholista)
print(desvio)
print(media)
