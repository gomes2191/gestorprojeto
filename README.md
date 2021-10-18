# Gestor de projeto
## _Um simples Gestor de Projetos_

[![Build Status](https://travis-ci.org/joemccann/dillinger.svg?branch=master)](https://travis-ci.org/joemccann/dillinger)

Esse é um simples sistema para gestão de projeto, com ele você consegue acompanhar o andamento de determinados projetos estando esse com suas devidas atividades cadastradas.

## Funcionalidades

- Cadastrar, excluir, editar e visualizar Projeto
- Progresso do projeto, permiti acompanhar a evolução do projeto, e estado atual desse, exemplo se o projeto está atrasado ou em dia.
- Cadastrar, excluir, editar e visualizar Atividades vinculadas a um determinado projeto

O Sistema também possui um campo de busca em Ajax que permite ao usuário buscar determinado Projeto estando ele na Página (Projetos), a mesma funcionalidade se aplica a página (Atividades).
Ambas as páginas ainda possuem um filtro de número de registro por página onde o valor passado será a quantidade de registro que será apresentado na página.

> Na construção da aplicação foi utilizado a arquitetura de software MVC - Model (modelo) View (visão) e Controller (Controle), propiciando uma melhor organização estrutural do sistema, tornando a comunicação de entre a interface do usuário e banco mais rápida dinãmica.
> O projeto foi construindo tendo como base o padrão de desenvolvimento orientado a objeto (POO).

## Especificações Técnica

O sistema foi construindo com as seguintes tecnologia:

- [HTML5, CSS3, PHP, JavaScript, Twitter Bootstrap, jQuery e PHP 7.+, MySQL 8.0]


Link para o repositório https://github.com/gomes2191/projectmanager
 no GitHub.

## Instalação

A aplicação exige o  [composer.json ](https://getcomposer.org/) instalado.

Instalação das dependências necessárias para o composer.

```sh
sudo apt-get -y install php php-zip php-common php-curl php-cli php-mbstring php-common php-json php-opcache php-readline php-xml php-dev php-gd php-pear php-imagick php-mysql php-pspell php-xsl php-xdebug -y
```

Clone da aplicação e Instalação dessa.
```sh
cd ~
mkdir development
cd development
git clone https://github.com/gomes2191/projectmanager.git
composer install
```


Instalação do (Docker) para rodar a aplicação.
```sh
cd ~/projectmanager/docker-compose/

docker-compose build sw

docker-compose up -d
```
Apos realizar todas essas etapas basta abrir o browser e digitar na url: http://localhost e terá acesso ao sistema.
## Considerações finais

Diante do projeto proposto, um dos maiores obstáculo foi o tempo, posto que trabalho e tenho pouco tempo disponível.
Mas consegui arrumar um tempo na madrugada e finalizar o projeto reaproveitando partes de aplicações que havia desenvolvido adaptando a esse Projeto.
