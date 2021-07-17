#include <stdio.h>
#include <stdlib.h>

//Programa que exemplifica o endereçamento virtual de um programa
//O interessante aqui é que os endereços da pilha (chamada de método)
//decrescem a medida que os métodos são invocados
//De forma contrária os endereços da heap aumentam
//De forma reduzida a pilha "cresce para baixo" e a heap "cresce para cima"

int fat(int n) {
	
	printf("Endereço de n: %d, %ld\n",n,&n);
	if (n==0)
		return 1;
	else
		return n*fat(n-1);
}

int main(void) {
	
		int a[10];

		int stack;
		stack = fat(7);
		//printf("%d",stack);
		
		int* heap;
		heap = malloc(10*sizeof(int));
		
		for(int i=0; i<10; i++)
			printf("Endereço de a[%d] = %ld\n", i, &a[i]);
			
		for(int i=0; i<10; i++)
			printf("Endereço de heap[%d] = %ld\n", i, &heap[i]);
		
		free(heap);
			
		char l;
		scanf("%c",&l);
}
