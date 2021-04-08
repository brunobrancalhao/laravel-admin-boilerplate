# Passos para executar aplicação

----------

## .ENV
Renomeie o .env.example para .env


## Caso seja a primeira vez que vai rodar a aplicação
Execute: 
>  **docker run --rm \
    -v $(pwd):/opt \
    -w /opt \
    laravelsail/php74-composer \
    composer install**

## Caso ja tenha rodado a aplicação e possua a pasta vendor
#### Execute

>  **alias sail='bash vendor/bin/sail'**
>  **sail up -d'**


## Comandos sail
##### Documentação [Laravel sail](https://laravel.com/docs/8.x/sail "Heading link")

