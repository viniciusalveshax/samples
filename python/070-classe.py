# Exemplo feito a partir de https://pythonacademy.com.br/blog/introducao-a-programacao-orientada-a-objetos-no-python

class Pessoa:

  def teste(a=10):
    print(a)
  def __init__(self, nome: str, idade: int, altura: float):
    self.nome = nome
    self.idade = idade
    self.altura = altura

  def dizer_ola(self):
    print(f'Olá, meu nome é {self.nome}. Tenho {self.idade} '
          f'anos e minha altura é {self.altura}m.')

  def cozinhar(self, receita: str):
    print(f'Estou cozinhando um(a): {receita}')

  def andar(self, distancia: float):
    print(f'Saí para andar. Volto quando completar {distancia} metros')


pessoa1 = Pessoa(nome="Vinicius", idade=22, altura=1.80)
pessoa1.dizer_ola()
pessoa1.andar(300)
