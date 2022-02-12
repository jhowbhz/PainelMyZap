# 🚀 Painel MyZap2.0 Com ZendFramework

## Descrição

Esse é um painel criado como estudo pessoal do framework (Zend Framework MVC) 
não foi criado para fins comerciais, mas você está livre para utilizar, e melhorar
da forma que quiser.

## 📖 Instalação

```bash
$ crontab -e
```

Adicione essa linha 

```bash
$ Adicione essa linha 
```

Clone o repositorio oficial

```bash
$ git clone xxxxxxxxxxxxxx /opt/
```

## 🐋 Utilizando docker

```bash
$ cd path/to/install
$ php -S 0.0.0.0:8080 -t public
# OR use the composer alias:
$ composer run --timeout 0 serve
```

## 🏃Pronto, agora é so iniciar o painel

```bash
$ cd path/to/install
$ php -S 0.0.0.0:8080 -t public
# OR use the composer alias:
$ composer run --timeout 0 serve
```

## 📌 Utilizando com Nginx

To setup nginx, open your `/path/to/nginx/nginx.conf` and add an
[include directive](http://nginx.org/en/docs/ngx_core_module.html#include) below
into `http` block if it does not already exist:

```nginx
http {
    # ...
    include sites-enabled/*.conf;
}
```

Create a virtual host configuration file for your project under `/path/to/nginx/sites-enabled/zfapp.localhost.conf`
it should look something like below:

```nginx
server {
    listen       80;
    server_name  zfapp.localhost;
    root         /path/to/zfapp/public;

    location / {
        index index.php;
        try_files $uri $uri/ @php;
    }

    location @php {
        # Pass the PHP requests to FastCGI server (php-fpm) on 127.0.0.1:9000
        fastcgi_pass   127.0.0.1:9000;
        fastcgi_param  SCRIPT_FILENAME /path/to/zfapp/public/index.php;
        include fastcgi_params;
    }
}
```
## 📌 Utilizando com Apache

To setup apache, setup a virtual host to point to the public/ directory of the
project and you should be ready to go! It should look something like below:

```apache
<VirtualHost *:80>
    ServerName zfapp.localhost
    DocumentRoot /path/to/zfapp/public
    <Directory /path/to/zfapp/public>
        DirectoryIndex index.php
        AllowOverride All
        Order allow,deny
        Allow from all
        <IfModule mod_authz_core.c>
        Require all granted
        </IfModule>
    </Directory>
</VirtualHost>
```