
# Sobre 

Teste de conhecimento Loja Virtual


# Instalacao

## Pre requisitos:

- [Php 7.2](https://www.php.net/releases/8.0/en.php).
- [Laravel 7.0](https://laravel.com/docs/7.x).
- [Docker](https://www.docker.com)


## Clonando Repositório

```
git clone https://github.com/pitombeira00/TestLojaVirtual.git
```

## Composer
```
docker-compose up -d
docker-compose exec app composer update
docker-compose exec app composer install
```

## Criando .ENV

Copie o arquivo .env.example e deixe somente .env, nele substitua as informações do banco:
```
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=lojavirtual
DB_USERNAME=root
DB_PASSWORD=teste
```

## Gerar Key
```
php artisan key:generate
```

## Servicos e Banco

Assim que você informou o banco, host e o password no .env, agora é a hora de subir o serviço.
```
docker-compose up -d

##Gere as tabelas no banco de dados com o migrate executada diretamente no app.

docker-compose exec app php artisan migrate
```

## Gerar Token

POST /api/token
```
#HEADERS
Accept: application/json

#GERAR TOKEN
{
  "name": "Loja Virtual",
  
}
```
## Incluir Usuário

POST /api/user
```
#HEADERS
Accept: application/json
OU
form-data

#BODY
{
  "name": "Danilo Pitombeira",
  "email": "danilo@user.com",
  "password": "teste123",
  "password_confirmation": "teste123",
  "birth": "1000-01-31",
  "phone": "87999998888",
  "social_number": "12312312313",
  "cep": "56328140"     
}
```


## Listar Todos os Usuário

GET /api/users
```
#HEADERS
Authorization: Bearer [TOKEN]
```

Resposta

```
{
    "status": "Success",
    "message": "All Users",
    "data": {
        "users": [
            {
                "id": 1,
                "name": "danilo pitombeira",
                "email": "danilo@user.com",
                "birth": "1000-01-31",
                "phone": "87999998888",
                "social_number": "12312312313",
                "cep": "56328140",
                "state": "PE",
                "city": "Petrolina",
                "neighborhood": "Vila Eduardo",
                "street": "Rua Getúlio Vargas",
                "created_at": "2021-10-28T11:30:58.000000Z",
                "updated_at": "2021-10-28T14:47:05.000000Z"
            }
        ]
    }
}
```

## Listar Um Usuário

GET /api/users/{id}
```
#HEADERS
Authorization: Bearer [TOKEN]
```

Resposta

```
{
    "status": "Success",
    "message": "user",
    "data": {
        "user": {
            "id": 1,
            "name": "danilo pitombeira",
            "email": "danilo@gmail.com1",
            "birth": "1000-01-31",
            "phone": "87999998888",
            "social_number": "12312312313",
            "cep": "56328140",
            "state": "PE",
            "city": "Petrolina",
            "neighborhood": "Vila Eduardo",
            "street": "Rua Getúlio Vargas",
            "created_at": "2021-10-28T11:30:58.000000Z",
            "updated_at": "2021-10-28T14:47:05.000000Z"
        }
    }
}
```

## Deletar Um Usuário

DELETE /api/users/{id}
```
#HEADERS
Authorization: Bearer [TOKEN]
```

Resposta

```
{
    "status": "Success",
    "message": "User Delete Success",
    "data": null
}
```

## Editar Um Usuário

Utilizando Form-Data, é necessário enviar o parâmetro
_method = PUT

Os campos alteráveis são:
```
{
  "name": "Danilo Prazeres",
  "password": "teste333",
  "password_confirmation": "teste333",
  "birth": "2020-01-31",
  "phone": "87999998888",
  "cep": "48903190"   
  "_method": "PUT"  
}

```

Utilizando Json.
PUT /api/users/{id}
```
#HEADERS
Authorization: Bearer [TOKEN]

#BODY
{
  "name": "Danilo Prazeres",
  "password": "teste333",
  "password_confirmation": "teste333",
  "birth": "2020-01-31",
  "phone": "87999998888",
  "cep": "48903190" 
}

```

Resposta

```
{
    "status": "Success",
    "message": "Edit Success",
    "data": {
        "user": {
            "id": 1,
            "name": "Danilo Prazeres",
            "email": "danilo@gmail.com1",
            "birth": "2020-01-31",
            "phone": "87999998888",
            "social_number": "12312312313",
            "cep": "48903190",
            "state": "BA",
            "city": "Juazeiro",
            "neighborhood": "Santo Antônio",
            "street": "Rua Joaquim Bispo dos Santos",
            "created_at": "2021-10-28T11:30:58.000000Z",
            "updated_at": "2021-10-28T17:29:17.000000Z"
        }
    }
}
```

## Melhorias Futuras

- Mais validações de retorno ou aplicação de um token para cada usuário criado;

## License

Open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
