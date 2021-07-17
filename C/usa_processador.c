#include <stdio.h>
#include <math.h>

// Programa que usa o processador com o interesse de demonstrar
// o uso dos comandos nice e taskset do Linux

// Compile com gcc codigo.c -lm para linkar com a biblioteca matemática

int main(void) {
	
		float numero=0.0;
	
		while(1) {
			
			powf(numero, 2.0);
			
			numero = numero + 1.0;
			
		}	
		
}

