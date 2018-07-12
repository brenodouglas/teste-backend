# Projeto para teste 

## Requisitos
* PHP7+
* Composer

## Como rodar
* Clone ou baixe o projeto para uma pasta de sua preferencia
* Instale todas as dependencias do [Composer](getcomposer.org/download) com o seguinte comando: 
```shell
composer install
````

* Rodando com servidor php embutido:
```shell
composer run server
# acesse em http://localhost:8000
```

* Rodando testes:
```shell
composer run test
#Ou caso esteja usando docker
docker-compose exec app composer run test
```

* Rodando com docker (caso não tenha esta porta disponivel a recomendação é que troque no arquivo docker-compose.yaml linha 10):
```shell
docker-compose up -d
# acesse em http://localhost
```