#!/bin/bash

#CHECANDO SESSÕES
curl --location --request POST 'http://localhost:9000/painel/sessoes/checar' \
--form 'chave="1234"'
