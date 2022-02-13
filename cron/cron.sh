#!/bin/bash

#CHECANDO SESSÕES
curl --location --request POST 'http://localhost:9000/painel/sessoes/checar' \
--form 'id="1"' \
--form 'chave="1234"'