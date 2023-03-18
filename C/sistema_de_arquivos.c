/*

Modelagem de um sistema de arquivos 
Código original por André Rosa, Diego Oliveira e Vinícius Hax (2007)

I-Node  --  	100 bytes - nome
		1 byte - arquivo ou diretorio (0 p/ diretorio e 1 / arquivo)
		2 byte - tamanho mais significativo = 101, menos significativo = 102


*/

#include<stdio.h>

#define MAX_BLOCOS 65536
#define TAMANHO_BLOCO 512
#define FINAL TAMANHO_BLOCO*MAX_BLOCOS
#define DIRETORIO 0
#define ARQUIVO 1
#define LIVRE 1
#define OCUPADO 0
#define FINAL_INODES 1024
#define BYTE 8
#define FINAL_MB_INODES FINAL_INODES/BYTE
#define FINAL_MB MAX_BLOCOS/BYTE

char ea[FINAL];
int end_raiz;
int path = 17*TAMANHO_BLOCO;  //path eh o endereco fisico.

int bit_livre(char* bloco){
	int i,j;
	for(i = 0x01, j = 0; i <= 0x80; ++j, i=i*2){
		if ( ( (char) i & (*bloco) ) == (char) 0x0){
			return j;
			}
		}
}

void set_bit(char* byte, int bit){
	*byte = *byte | ( (unsigned int) pow((float) 2, (float) bit));
}

void reset_bit(char* byte, int bit){
	char reset_byte = (unsigned int) pow((float) 2, (float) bit);
	*byte = *byte & (0xff - reset_byte);
}

int busca_bloco_inode(void){
// Busca blocos de inodes livres
// 128 bytes, eh possivel mapear 1024 blocos
	int i;
	for(i=0; i<FINAL_MB_INODES; i++)
		if (ea[i] != (char) 0xff){
			return (8*i + bit_livre(&ea[i]) );
			}
	return 0;
}

int busca_bloco_livre(void){
	int i;
	for(i=FINAL_MB_INODES; i<FINAL_MB; i++)
		if (ea[i] != (char) 0xff){
			return (8*i + bit_livre(&ea[i]) );
			}
	return 0;
}

void altera_mapa(int bl_logico, int status){
	int byte_mapa;
	int bit_mapa;
	byte_mapa = bl_logico / 8;
	bit_mapa = bl_logico % 8;
	if (status == OCUPADO)
		set_bit(&ea[byte_mapa], bit_mapa);
	else
		reset_bit(&ea[byte_mapa], bit_mapa);
}

void libera_bloco(int bl_logico){
	altera_mapa(bl_logico, LIVRE);
	int end_real = converte_bloco(bl_logico);
	int i;
	for (i=end_real; i<end_real+512; i++)
		ea[i] = 0;
}

int converte_bloco (int bl_virtual){
	return bl_virtual*TAMANHO_BLOCO;
}

int conta_blocos(int bl_virtual){ //Se o bloco virtual passado como parametro eh um diretorio, conta quantos arquivos e diretorios existem no mesmo, se for um arquivo, conta quantos blocos de dados ele possui.
	int end_real = converte_bloco(bl_virtual);
	int contador=0, i, j, end_indireto;
	for(i=end_real+128; i<end_real+384; i+=2)
		if ((ea[i]*256 + ea[i+1]) == 0)
			break;
		else
			contador++;
	for(i=end_real+384; i<end_real+512; i+=2){
 		if ((ea[i]*256 + ea[i+1]) != 0){
 			end_indireto = ea[i]*256 + ea[i+1];
 			for(j=end_indireto; j<end_indireto+512; j+=2){
 				if ((ea[j]*256 + ea[j+1]) == 0){
 					break;
 				}
 				else{
 					contador++;
 				}
 			}
		}
		else
			break;
	}
	return contador++;
}

int ultimo_endereco_valido(int bl_virtual){
	//Se bloco virtual for um diretorio, retorna o ultimo endereco de um dos seus arquivos ou diretorios, se for um arquivo, retorna o endereco do ultimo bloco de dados
	int end_real = converte_bloco(bl_virtual);
	int end_direto = 0, end_indireto, i, j;
	for(i=end_real+128; i<end_real+384; i+=2)
		if ((ea[i]*256 + ea[i+1]) != 0)
			end_direto = ea[i]*256 + ea[i+1];
	for(i=end_real+384; i<end_real+512; i+=2)
		if ((ea[i]*256 + ea[i+1]) != 0){
			end_indireto = ea[i]*256 + ea[i+1];
			for(j=end_indireto; j<end_indireto+512; j+=2)
				if ((ea[j]*256 + ea[j+1]) != 0)
					end_direto = ea[j]*256 + ea[j+1];
		}
	return end_direto;
}

void deleta_endereco(int bl_virtual, int end_deletar){
	//Deleta um endereco de um bloco virtual
	int end_valido = ultimo_endereco_valido(bl_virtual);
	int end_real = converte_bloco(bl_virtual);
	int end_direto = 0, end_indireto, i, j;
	if (end_deletar == end_valido)
		end_valido = 0; //So existe um bloco

	for(i=end_real+128; i<end_real+384; i+=2){
		if ((ea[i]*256 + ea[i+1]) == end_valido){
			ea[i] = 0;
			ea[i+1] = 0;
			}
		if ((ea[i]*256 + ea[i+1]) == end_deletar){
			ea[i] = end_valido/256;
			ea[i+1] = end_valido%256;
			}
		
		}
	for(i=end_real+384; i<end_real+512; i+=2)
		if ((ea[i]*256 + ea[i+1]) != 0){
			end_indireto = ea[i]*256 + ea[i+1];
			for(j=end_indireto; j<end_indireto+512; j+=2){
				if ((ea[i]*256 + ea[i+1]) == end_valido){
					ea[i] = 0;
					ea[i+1] = 0;
				}
				if ((ea[j]*256 + ea[j+1]) == end_deletar){
					ea[j] = end_valido/256;
					ea[j+1] = end_valido%256;
					return;
				}
			}
		}
}

int existe (char* nome) {
	int i,j,k,end,temp,end_ret;
	char comp[100];	
	
	
	for(i=path+128;i<path+384;i=i+2){
		end = converte_bloco(ea[i]*256 + ea[i+1]);
		if (end != 0){   //existe algo
			end_ret = end;
			for(j=0;j<100;++j){  //concatenacao
			comp[j] = ea[end];
			++end;
			}

			if(strcmp(nome,comp) == 0) return end_ret;
		}
		else return 0;

	}
	for(i=path+384;i<path+512;i=i+2){
		end = converte_bloco(ea[i]*256 + ea[i+1]); //endereco do bloco de end.
		if(end != 0){			
			for(k=0;k<256;++k){ //analisa soh pares
				//temp = composicao do end. do bloco de end.
				temp = converte_bloco(ea[end]*256 + ea[end+1]);
				end_ret = temp;
				if (temp != 0){				
					for(j=0;j<100;++j){
						comp[j] = ea[temp];
						++temp;
					}

				}
				if(strcmp(nome,comp) == 0)
					return end_ret;
				
				end = end+2;
			}
		}
		else return 0;
	}

	return 0;

}

void muda_nome (int bl_logico, char* nome){
	int end_real = converte_bloco(bl_logico);
	int i,j;
	
	for(j=0,i = end_real; i<end_real+100;++i){
		if (nome[j] == '\0') break;
		ea[i] = nome[j];
		++j;
	}
}

void renomeia(char* nome_antigo, char* nome_novo){
	if (strcmp(nome_antigo, nome_novo) == 0){
		printf("O nome antigo e o mesmo que o novo.\n");
		return;
		}
	int end_inode_antigo = existe(nome_antigo);
	muda_nome(end_inode_antigo/TAMANHO_BLOCO, nome_novo);
}

void mostra_nome (int end_logico){
	int end_real = converte_bloco(end_logico);
	int i;
	for(i = end_real; i<end_real+100;++i){
		if (ea[i] == '\0') break;
		putchar(ea[i]);
	}
}

void muda_tamanho (int end){
	int end_real = converte_bloco(end);	
}

void muda_especie (int end, int da){
	int end_real = converte_bloco(end);
	
	ea[end_real+100] = da;
}

int verifica_especie(int end_real){
	char especie = ea[end_real+100];
	if (especie == DIRETORIO)
		return DIRETORIO;
	else
		return ARQUIVO;
	}

void imprime_ea (void) {
	int i;
	for(i = 0; i<FINAL; ++i)
		printf("%x\n",ea[i]);
}

void criadir (char* nome){

	int bl_virtual = cria_inode(nome);
	int end_real = converte_bloco(bl_virtual);
	int i,flag=0, bl_papai;
	if (bl_virtual == 0)
		printf(" Nao foi possivel criar um diretorio.\n");
	else{
		muda_especie(bl_virtual,DIRETORIO);
		printf("Diretorio '%s' criado com sucesso\n",nome);
		bl_papai = path/TAMANHO_BLOCO;
		ea[end_real+128] = bl_papai/256; //Parte mais significativa do endereco do pai
		ea[end_real+129] = bl_papai%256; //Parte menos significativa do endereco do pai
	}

}

void inicializa_sistema (void) {
	int i;
	end_raiz = converte_bloco(17);
	ea[0] = 0xff;
	ea[1] = 0xff;
	ea[2] = 0x01;
	for (i=3;i<FINAL;++i)
		ea[i] = 0x00;
	criadir("/");
	//Apaga ligacoes de barra para o pai, ou seja, para ele mesmo
	ea[end_raiz+128] = 0;
	ea[end_raiz+129] = 0;
}

void listar_diretorio(){
	int bl_logico = path/TAMANHO_BLOCO;
	printf("Listando filhos de: ");
	mostra_nome(bl_logico);
	putchar('\n');
	int end_real = converte_bloco(bl_logico);
	int bl_logico_filho, end_indireto, i, j;
	if (bl_logico == 17) // O diretorio raiz nao tem ligacao para o papai
		i=ea[end_real+128]*256 + ea[end_real+129];
	else
		i=ea[end_real+130]*256 + ea[end_real+131];
	if(i == 0){printf("Diretorio nao possui nenhum filho para ser listado.\n");return;}//;}
	if(bl_logico == 17){
		//Procura nos enderecos diretos do raiz
		for(i=end_real+128;i<end_real+384;i=i+2){
			if ((ea[i]*256 + ea[i+1]) == 0) //Endereco direto indisponivel
				break;
			bl_logico_filho = ea[i]*256 + ea[i+1];
			mostra_nome(bl_logico_filho);
			if (verifica_especie(bl_logico_filho*TAMANHO_BLOCO) == DIRETORIO)
				printf(" - Diretorio.\n");
			else
				printf(" - Arquivo.\n");
			}
	}
	else{
		//Procura nos enderecos diretos de outros diretorios
		for(i=end_real+130;i<end_real+384;i=i+2){
			if ((ea[i]*256 + ea[i+1]) == 0) //Endereco direto indisponivel
				break;
			bl_logico_filho = ea[i]*256 + ea[i+1];
			mostra_nome(bl_logico_filho);
			if (verifica_especie(bl_logico_filho*TAMANHO_BLOCO) == DIRETORIO)
				printf(" - Diretorio.\n");
			else
				printf(" - Arquivo.\n");
			}
	}
	//Procura nos enderecos indiretos
	for(i=end_real+384;i<end_real+512;i+=2){
		if ((ea[i]*256+ea[i+1]) == 0) //endereco indireto indisponivel
			break;
		end_indireto = ea[i]*256 + ea[i+1];
		for(j=end_indireto; j<512; j+=2){
			bl_logico_filho = ea[j]*256 + ea[j+1];
			mostra_nome(bl_logico_filho);
			if (verifica_especie(bl_logico_filho*TAMANHO_BLOCO) == DIRETORIO)
				printf(" - Diretorio.\n");
			else
				printf(" - Arquivo.\n");
			}
		}
}

int cria_inode(char* nome){
	int bl_virtual = busca_bloco_inode();
	int end_real = converte_bloco(bl_virtual);
	int i,flag=0;

	if (bl_virtual == 0){
		printf("Nao possui espaco para criacao de mais um i-node.");
		return 0;
		}

	if (existe(nome)){
		printf("O nome '%s' ja esta sendo usado. ",nome);
		return 0;
		}

	altera_mapa(bl_virtual, OCUPADO);
	muda_nome(bl_virtual, nome);
	for(i=end_real+128;i<end_real+512;++i){
		ea[i] = 0;
	}

// 		ligacao do pai para o filho
	for(i=path+128;i<path+384;i+=2){
		if ((ea[i]*256+ea[i+1]) == 0){//endereco direto disponivel
			ea[i]=bl_virtual/256;
			ea[i+1]=bl_virtual%256;
			flag=1;
			break;
		}
	}
	if(flag == 0){
		for(i=path+384;i<path+512;i+=2){
			if((ea[i]*256+ea[i+1]) == 0){
				int end;
				end = ea[i]*256 + ea[i+1];
				ea[end]=bl_virtual/256;
				ea[end+1]=bl_virtual%256;
				flag=1;
				break;
			}
		}		
	}
	
	return bl_virtual;
}

void mudadir (char* nome){
	int dir;
	dir = existe(nome);	
	if(dir == 0) goto saida; //isso aqui tava acontecendo qnd dava um mudadir para um inexistente
	if (verifica_especie(dir) == DIRETORIO){
		path = dir;
		return;
	}
	saida:;
	printf("Nao existe um diretorio com o nome '%s'.\n",nome);
}

void lerarquivo(char* nome){
	int end_real = existe(nome);
	if (end_real == 0)
		printf("Nao existe arquivo com nome '%s'.\n",nome);
	int tamanho = ea[end_real+101]*256 + ea[end_real+102];
	int ultimo_endereco = ultimo_endereco_valido(end_real/TAMANHO_BLOCO);
	int end_tmp_indireto, end_tmp,i,j, inicio, fim;
	if ((ea[end_real+128]*256 + ea[end_real+129]) == 0){
		printf("O arquivo %s nao tem conteudo.\n",nome);
		return;
		}
	else
		printf("Conteudo do arquivo %s:\n",nome);
	for(i=end_real+128;i<end_real+384;i=i+2){ //Percorre todos os blocos de dados
			end_tmp = ea[i]*256+ea[i+1];
			if (end_tmp == 0){
				break;
				}
			else
				{
				inicio = end_tmp*TAMANHO_BLOCO;
				if (end_tmp != ultimo_endereco)
					fim = inicio + TAMANHO_BLOCO;
				else
					fim = inicio + tamanho;
				for(j=inicio; j<fim; ++j) //Percorre os bytes do bloco de dados
					printf("%c",ea[j], j, j*TAMANHO_BLOCO);
				}
			}
	for(i=end_real+384; i<end_real+512; i+=2){ //Percorre os blocos indiretos
		end_tmp_indireto = ea[i]*256+ea[i+1];
		if (end_tmp_indireto == 0)
			break;
		for(j=end_tmp_indireto; j<end_tmp_indireto+512; j+=2){
			end_tmp = ea[j]*256+ea[j+1];
			inicio = end_tmp;
			if (end_tmp != ultimo_endereco)
					fim = inicio + TAMANHO_BLOCO;
				else
					fim = inicio + tamanho;
			if (end_tmp == 0)
				break;
			for(j=inicio; j<fim; ++j) //Percorre os bytes do bloco de dados
				printf("%c",ea[j]);
		}
	}
	printf("\n");
}

void escreverarquivo (char* nome, char dado){
	int achou_bloco=0;
	int end_real = existe(nome);
	if (end_real == 0){
		printf("Nao existe arquivo com nome %s. Nao foi possivel escrever.\n",nome);
		return;
		}
	int tamanho, bl_logico, end_tmp, j, i, bl_tmp, ultimo_bloco, novo_bloco;
	tamanho = ea[end_real+101]*256 + ea[end_real+102];
	if(tamanho != 0){
		//Adiciona no bloco que ainda tem espaco
		bl_logico = ultimo_endereco_valido(end_real/TAMANHO_BLOCO);
		achou_bloco = 1;
		}
	else{
		bl_logico = busca_bloco_livre();
		for(i=end_real+128;i<end_real+384;i=i+2){
				//Busca nos enderecos diretos
				bl_tmp = ea[i]*256 + ea[i+1];
				if (bl_tmp == 0){
					ea[i] = bl_logico / 256;
					ea[i+1] = bl_logico % 256;
					achou_bloco = 1;
					break;
				}
				else
					break;
			}
		if (achou_bloco == 0)
			//Continua a busca nos enderecos indiretos
			for(i=end_real+386; i<end_real+512; i=i+2){
				end_tmp = ea[i]*256 + ea[i+1];  //End tmp aponta para um bloco de enderecos
				if (end_tmp != 0)
					for(j=end_tmp; j<512; j+=2){
						//ea[j] se nao for zero aponta para um bloco de dados
						if ((ea[j]*256 + ea[j+1]) != 0)
							ea[j] = bl_logico / 256;
							ea[j+1] = bl_logico % 256;
							achou_bloco = 1;
							break;
						}
				if (achou_bloco)
					break;
				}
		}

	if (achou_bloco){
 		ea[bl_logico*TAMANHO_BLOCO+tamanho] = dado;
		tamanho++;
		if (tamanho == 512)
			tamanho = 0;
		ea[end_real+101] = tamanho / 256;
		ea[end_real+102] = tamanho % 256;
		}
	else
		printf("Nao eh possivel adicionar mais dados ao arquivo.\n");
}

void criaarquivo (char* nome){

	int bl_virtual = cria_inode(nome);
	if (bl_virtual == 0)
		printf("Nao foi possivel criar um arquivo.\n");
	else
		{
		muda_especie(bl_virtual,ARQUIVO);
		printf("Arquivo '%s' criado com sucesso.\n",nome);
		}
}

void delarquivopelobloco(int bl_logico){
	int end_real=converte_bloco(bl_logico);
	int i,j, end_direto, end_indireto;
	for(i=end_real+128; i<end_real+384; i=i+2){ //Percorre os blocos diretos para libera-los
		end_direto = ea[i]*256 + ea[i+1];
		if (end_direto != 0)
			altera_mapa(end_direto, LIVRE); //Libera bloco de dados
	
	}
	for(i=end_real+384; i<end_real+512; i+=2){ //Percorre os blocos indiretos para libera-los
		end_indireto = ea[i]*256 + ea[i+1];
		if (end_indireto != 0){
			for(j=end_indireto; j<end_indireto+512; j+=2){
				end_direto = ea[j]*256 + ea[j+1];
				if (end_direto != 0)
					altera_mapa(end_direto, LIVRE); //Libera bloco de dados
			}
			altera_mapa(end_indireto, LIVRE); //Libera bloco de endereços
		}
		
	}

	deleta_endereco(path/TAMANHO_BLOCO, end_real/TAMANHO_BLOCO); //Deleta o arquivo do papai
	altera_mapa(bl_logico, LIVRE);

}

void deldirpelobloco(int bl_logico){
	int end_real=converte_bloco(bl_logico);
	int i,j, end_direto, end_indireto, tipo;
	for(i=end_real+130; i<end_real+384; i+=2){ //Percorre os blocos diretos para libera-los
		end_direto = ea[i]*256 + ea[i+1];
		if (end_direto != 0){
			tipo = verifica_especie(end_direto*TAMANHO_BLOCO);
			if (tipo == DIRETORIO)
				deldirpelobloco(end_direto);
			else
				delarquivopelobloco(end_direto);
			altera_mapa(end_direto, LIVRE); //Libera bloco de dados
			}
		else
			break;
	}
	for(i=end_real+384; i<end_real+512; i+=2){ //Percorre os blocos indiretos para libera-los
		end_indireto = ea[i]*256 + ea[i+1];
		if (end_indireto != 0){
			for(j=end_indireto; j<end_indireto+512; j+=2){
				end_direto = ea[j]*256 + ea[j+1];
				if (end_direto != 0){
					tipo = verifica_especie(end_direto*TAMANHO_BLOCO);
					if (tipo == DIRETORIO)
						deldirpelobloco(end_direto);
					else
						delarquivopelobloco(end_direto);
					altera_mapa(end_direto, LIVRE); //Libera bloco de dados
					}
			}
			altera_mapa(end_indireto, LIVRE); //Libera bloco de endereços
		}
		
	}

	deleta_endereco(path/TAMANHO_BLOCO, end_real/TAMANHO_BLOCO); //Delete o arquivo do papai
	altera_mapa(bl_logico, LIVRE);

}

void deldir (char* nome){
	int end_real=existe(nome);
	if (end_real != 0){
		deldirpelobloco(end_real/TAMANHO_BLOCO);
		printf("Diretorio com nome '%s' deletado\n",nome);
		}
	else{
		printf("Nao existe um diretorio com nome '%s'\n",nome);
		}
}

void delarquivo(char* nome){
	int end_real=existe(nome);
	if (end_real != 0){
		delarquivopelobloco(end_real/TAMANHO_BLOCO);
		printf("Arquivo com nome '%s' deletado\n",nome);
		}
	else
		printf("Nao existe um arquivo com nome '%s'\n",nome);
}

int main(void){

int end_tmp;

inicializa_sistema();

listar_diretorio();
criaarquivo("arqui1");
listar_diretorio();
delarquivo("arqui1");
criaarquivo("arqui2");
criaarquivo("arqui2");
criaarquivo("arqui3");
criaarquivo("arqui1");
listar_diretorio();

lerarquivo("arqui3");
escreverarquivo("arqui3", 'a');
lerarquivo("arqui3");
escreverarquivo("arqui3", 'b');
lerarquivo("arqui3");

mudadir("diretorio");

criadir("dir1");
listar_diretorio();

mudadir("dir1");
listar_diretorio();

criadir("dir2");
criaarquivo("arqui4");
escreverarquivo("arqui4", 'b');
lerarquivo("arqui4");

listar_diretorio();
criadir("dir3");
mudadir("dir3");

criaarquivo("arqui5");

printf("Existe arquivo com nome 'arqui5'?\n");
end_tmp = existe("arqui5");
if (end_tmp != 0)
	printf("Sim. E sua localizacao e no endereco %d do espaco de armazenamento. Bloco %d\n",end_tmp, end_tmp/TAMANHO_BLOCO);

renomeia("arqui5", "arquivo");
criadir("dir4");
renomeia("dir4", "diretorio");
listar_diretorio();
return 0;
}
	
