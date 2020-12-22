## API SALVA SEU ENDEREÇO NO BANCO DE DADOS.
+++++++++++++++

- [x] PHP
- [x] MYSQL
- [x] APACHE

+++++++++++++++
### DUMP ↓
[BAIXAR DUMP]("https://drive.google.com/file/d/15dU8bp1AX622I6XVdY6WBVvRdM9vwhLV/view?usp=sharing")

## GET


```
/api-php-cep/cep/read.php
```
## GET ONE

```
/api-php-cep/cep/read_one.php?id=1
```
## POST
```
/api-php-cep/cep/create.php

{
    "cep": 12345678 - seu cep
}
```
## PUT
```
/api-php-cep/cep/update.php

{
	"id": "ID",
	"cep": "CEP",
	"logradouro": "NOME DA RUA",
	"bairro": "NOME DO BAIRRO",
	"localidade": "LOCALIDADE",
	"uf": "UF"
}
```
## DELETE

```
/api-php-cep/cep/delete.php?id=19
```
## GERAR XLS (EXEL)

```
/api-php-cep/cep/exel.php
```