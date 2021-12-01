// Exemplo baseado em https://developer.mozilla.org/pt-BR/docs/Learn/Server-side/Express_Nodejs/Introduction

// Carrega o modulo do Express
var express = require("express");
var app = express();

app.get('/', function(req, res) {
		res.send('Olá Mundo\n');
		}
);

app.get('/recomendo', function(req, res) {
		res.header("Access-Control-Allow-Origin", "null");
		res.header("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept");
		json_response = {"recomendacoes":
					[
						{nome: "Recomendação 1", nota: 10},
						{nome: "Recomendação 2", nota: 9},
						{nome: "Recomendação mais ou menos", nota: 5}
					]
				}

		//res.send('Recomendações ....');
		res.json(json_response);
		}
);

app.use('/arquivos', express.static('arquivos'));

app.listen(8000, function() {
			console.log('Servidor executando em http://127.0.0.1:8000/');
			}
);
