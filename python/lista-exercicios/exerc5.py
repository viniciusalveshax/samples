lista = []
while(True):
    resposta = input("Digite uma palavra")
    if (resposta == "sair"):
        break
    else:
        lista.append(resposta) 
print("Saiu")
for palavra in lista:
    print(palavra)