## Iniciar o Projeto CustomerSystem

### Autor
   >Renan Alves da Silva
<br><br>

## Instalação de Dependências

> Instalar o docker: https://docs.docker.com/engine/install/ubuntu/ e seguir as instruções para a instalação em seu sistema operacional;

> Instalar o docker-compose: https://docs.docker.com/compose/install/ e seguir as instruções para a instalação em seu sistema operacional;

> Instalar o NODE.JS https://nodejs.org/dist/v12.19.0/node-v12.19.0-x64.msi

> Instalar o Angular execute o comando "npm install -g @angular/cli@9.1.1"

## Configuração de Ambientes

**backend/CustomerService:**

> Acesse o diretório "backend/CustomerService"

> Execute o comando "docker-composer up -d"

> Acesse o diretório "backend/CustomerService/environments/"

> Para testes em ambiente local acesse a environment "dev"

> Troque a string "MEU_IP" para o ip local de sua máquina nos arquivos "config.ini" e "database.ini"

> Acesse o diretório "backend/CustomerService/"

> Execute o comando "docker container exec customerservice-php php install.php dev", isso vai fazer com que o sistema 
> troque as váriaveis de configuração do sistema para o ambiente de dev, 
> o mesmo também pode ser utilizado em pipelines devops, para facilitar a configuração do ambiente correto.

> Execute o comando "docker container exec customerservice-php composer update"

> Para ambiente de testes a base de dados já está pré-configurada e presente na pasta "mysql-datavolume",
> mas caso seja necessário configurar uma nova, basta apenas apontar as configurações de ambiente para uma nova base de dados em branco
> e executar o comando "docker container exec customerservice-php ./vendor/bin/phinx migrate", a lib Phinx ficará responsável por 
> criar todas as tabelas e registros necessários para a inicialização do serviço.

> Para rodar os testes unitários do sistema basta executar o comando "docker container exec customerservice-php ./vendor/bin/phpunit --bootstrap init.php tests/"

**backend/UserService:**

> Acesse o diretório "backend/UserService"

> Execute o comando "docker-composer up -d"

> Acesse o diretório "backend/UserService/environments/"

> Para testes em ambiente local acesse a environment "dev"

> Troque a string "MEU_IP" para o ip local de sua máquina no arquivo "database.ini"

> Acesse o diretório "backend/UserService/"

> Execute o comando "docker container exec userservice-php php install.php dev", isso vai fazer com que o sistema 
> troque as váriaveis de configuração do sistema para o ambiente de dev, 
> o mesmo também pode ser utilizado em pipelines devops, para facilitar a configuração do ambiente correto.

> Execute o comando "docker container exec userservice-php composer update"

> Para ambiente de testes a base de dados já está pré-configurada e presente na pasta "mysql-datavolume",
> mas caso seja necessário configurar uma nova, basta apenas apontar as configurações de ambiente para uma nova base de dados em branco
> e executar o comando "docker container exec userservice-php ./vendor/bin/phinx migrate", a lib Phinx ficará responsável por 
> criar todas as tabelas e registros necessários para a inicialização do serviço.

> Para rodar os testes unitários do sistema basta executar o comando "docker container exec userservice-php ./vendor/bin/phpunit --bootstrap init.php tests/"

**frontend/CustomerSystem:**

> Acesse o diretório "frontend/CustomerSystem"

> Execute o comando "npm install"

> Para configurar os links de acesso aos serviços da aplicação para os ambientes, acesse o arquivo: "frontend/CustomerSystem/src/app/api.service.ts"

> Para iniciar a aplicação execute "ng serve", lembrando que este iniciará com o ambiente padrão configurado em "frontend/CustomerSystem/environments/environment.ts"

> Acesso ao sistema:
<br>
> Login: user; Senha: 1234567

## Documentação

> O sistema foi separado em dois microserviços "PHP" e um frontend "Angular", sendo eles:

**UserService:**
> Serviço responsável por tratar autenticações de usuários da API.

**CustomerService**
> Serviço responsável por tratar o cadastro de Clientes, tem como dependência o serviço "UserService", para autenticar os usuários da API.

**CustomerSystem**
> Interface de usuário do sistema de clientes.

**Arquitetura**
> A abordagem de microserviços foi escolhida visando a escalabilidade do sistema, assim então criando serviços independentes
> com suas respectivas regras de negócio. 
> Ambos serviços são Stateless, ou seja, não armazenam estado em seus containers,
> e ambos são maleáveis, podendo ser substituídos sem afetar o resto da aplicação.
