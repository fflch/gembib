#!/bin/bash

mysqlimport --ignore-lines=1 \
--columns=sugerido_por,\
insercao_por,\
tipo_material,\
subcategoria,\
capes,\
verba,\
tombo,\
tombo_antigo,\
cod_impressao,\
processo,\
fornecedor,\
nota_fiscal,\
tipo_aquisicao,\
moeda,\
preco,\
autor,\
titulo,\
edicao,\
volume,\
parte,\
fasciculo,\
local,\
editora,\
ano,\
colecao,\
isbn,\
escala,\
link,\
dpto,\
pedido_por,\
finalidade,\
procedencia,\
data_sugestao,\
created_at,\
updated_at,\
prioridade,\
status,\
observacao \
--fields-terminated-by=, \
fields-optionally-enclosed-by='\"' \
--local -u master -p gembib /home/thiago/itens.csv
