# Projeto para teste 

## Como rodar

* Clone ou baixe o projeto para uma pasta de sua preferencia
* Instale todas as dependencias do [Composer](getcomposer.org/download) com o seguinte comando: 
```shell
composer install
````

* Rodando com servidor php embutido na porta 8000:
```shell
composer run server
```

* Rodando com docker na porta 80 (caso não tenha esta porta disponivel a recomendação é que troque no arquivo docker-compose.yaml linha 10:
```shell
docker-compose up -d
```