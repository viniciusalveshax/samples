console.log("Olá");

ar = ['2004-11-08', '2004-10-27', '2004-10-28', '2004-05-13'];

var idades = ar.map(
		function(dta_nascimento){
			partes_data = dta_nascimento.split('-');
			dia = partes_data[2];
			mes = partes_data[1];
			ano = partes_data[0];
			dia_atual = 30;
			mes_atual = 9;
			ano_atual = 2022;
			idade = 999;
			if (mes < mes_atual)
				idade = ano_atual - ano;
			else
				if (mes == mes_atual)
					if (dia <= dia_atual)
	idade = ano_atual - ano;
			if (idade == 999)
				idade = ano_atual - ano - 1;
			return idade;
	});
	
console.log(idades);
