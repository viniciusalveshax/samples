# No python 3 use input ao inves de raw_input
lado1 = raw_input("Digite o tamanho do primeiro lado")
lado2 = raw_input("Digite o tamanho do segundo lado")
lado3 = raw_input("Digite o tamanho do terceiro lado")

if (lado1 == lado2) and (lado2 == lado3):
	print("Triangulo equilatero")
elif (lado1 == lado2) or (lado2 == lado3) or (lado1 == lado3):
		print("Triangulo isosceles")
	else:
		print("Triangulo escaleno")
		
		
		
