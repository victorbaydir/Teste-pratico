<p align="center"><img src="http://site.federalst.com.br/fsmail.jpg"></p>


# Teste prático - Federal Soluções Técnicas

## Instalação 
* Execute composer install
* Renomeie o arquivo .env.example para .env
* Configure o acesso do seu banco de dados postgree no arquivo .env
* Configure o email no arquivo .env
* Execute php artisan key:generate
* Execute php artisan migrate
* Execute php artisan db:seed

### Requisitos
- [X] Usar Laravel
- [X] Usar banco de dados Postgres
- [X] Utilizar Soft Deleting ao excluir veículos.
- [X] Não ter regra de negócio nos Controllers.
- [X] Usar Event e Notifications para enviar os e-mail.
- [X] Deixar informações no README.MD sobre como podemos executar sua aplicação.
- [X] Usar o github.

### Validações
Os campos abaixo só podem ser aceitos no formato:
- [X] Placa: Formato com três letras e quatro números (AAA1111).
- [X] Ano: Formato apenas com números com, no máximo, 4 dígitos.

#### Dicas após baixar o projeto:
- Rode as migrations.
- Rode as seeders.
- Esteja atento aos usuários padrões contidos na Seeder.
- A senha dos usuários é 'secret'.

