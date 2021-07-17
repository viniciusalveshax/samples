#!/bin/bash

# Roda prog3 (gerado a partir de usa_processador.c)
taskset 1 ./prog3 &

# Roda o mesmo programa mas com prioridade mais baixa
# Para o efeito ser notado é preciso rodar o programa 
# no mesmo processador, por isso o uso de taskset

# Quanto maior o valor de nice mais 'legal' é o processo com os demais
nice -n 10 taskset 1 ./prog3 &
