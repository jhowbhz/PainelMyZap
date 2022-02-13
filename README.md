# 🚀 Painel MyZap2.0 Com ZendFramework

## Descrição

Esse é um painel criado como estudo pessoal do framework (Zend Framework MVC) 
não foi criado para fins comerciais, mas você está livre para utilizar, e melhorar
da forma que quiser.
## 📖 Instalação
Clone o repositorio oficial

```bash
$ git clone https://github.com/jhowbhz/PainelMyZap.git /opt/PainelMyZap
```
## 🕒 Crontab checagem sessões
```bash
# adicionar permissao
$ chmod -R 0777 /opt/PainelMyZap/cron/cron.sh

# abrir o crontab
$ crontab -e

# Adicione a linha
$ 0 5 * * * /opt/PainelMyZap/cron/cron.sh --quiet
```
## ⚙️ Configurando 

```bash
# Altere a linha CHAVE_WEBOOK=1234
$ nano /opt/PainelMyZap/config/application.config.php
```
## 🌎 Iniciando servidor web

```bash
$ cd /opt/PainelMyZap
$ php -S 0.0.0.0:8080 -t public
# ou use o composer
$ composer run --timeout 0 serve
```

## 🏃Pronto, agora é so iniciar o painel

```bash
$ cd path/to/install
$ php -S 0.0.0.0:8080 -t public
# OR use the composer alias:
$ composer run --timeout 0 serve
```

# Screenshot
[<img src="https://i.imgur.com/TUNjHR3.png" width="250"/>]('https://i.imgur.com/TUNjHR3.png')
[<img src="https://i.imgur.com/PRsseeQ.png" width="250"/>]('https://i.imgur.com/PRsseeQ.png')
[<img src="https://i.imgur.com/A2y4Yge.png" width="250"/>]('https://i.imgur.com/A2y4Yge.png')
[<img src="https://i.imgur.com/UVck0Ha.png" width="250"/>]('https://i.imgur.com/UVck0Ha.png')
[<img src="https://i.imgur.com/I1CONQ3.png" width="250"/>]('https://i.imgur.com/I1CONQ3.png')
[<img src="https://i.imgur.com/yT388os.png" width="250"/>]('https://i.imgur.com/yT388os.png')
