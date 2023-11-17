resposta = input("Digite um número")
resposta_int = int(resposta)
while(resposta_int != 15):
    print("Código incorreto")
    resposta = input("Digite um número")
    resposta_int = int(resposta)
print("Acertou!")