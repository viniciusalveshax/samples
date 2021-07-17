#include <stdio.h>
#include <math.h>

// Programa simples em C que não faz nada interessante
// Foi feito simplesmente para servir de exemplo do 
// comando time do Linux

// Compile com gcc codigo.c -lm para linkar com a biblioteca matemática

int main(void) {
	
		float numero=0.0;
	
		while(numero < 2000000.0) {
			
			powf(numero, 2.0);
			
			numero = numero + 1.0;
			
			printf("%f\n", numero);
			
		}	
		
}

