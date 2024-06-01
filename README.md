# Sistema de Consultório de Psicologia
Este projeto é um sistema de gerenciamento de consultório de psicologia desenvolvido utilizando Vue.js, Electron e Laravel. Ele possui funcionalidades específicas para psicólogos, secretárias e usuários, permitindo o agendamento e administração de atendimentos.

## Índice
- Tecnologias Utilizadas
- Instalação
- Funcionalidades
- Como Usar

## Tecnologias Utilizadas
- Vue.js: Framework JavaScript para a construção de interfaces de usuário.
- Electron: Framework para a criação de aplicações desktop com JavaScript, HTML e CSS.
- Laravel: Framework PHP para desenvolvimento de aplicações web com uma sintaxe elegante e expressiva.
## Instalação
### Pré-requisitos
- Node.js
- PHP
- Composer
- MySQL

### Passos para Instalação
1. Clone o repositório:
`git clone https://github.com/seu-usuario/seu-repositorio.git
cd seu-repositorio
`


2. Instale as dependências do Laravel:
`cd backend
composer install
cp .env.example .env
php artisan key:generate
`


3. Configure o arquivo .env com as informações do banco de dados.


4. Execute as migrações e seeders:
`php artisan migrate --seed
`


5. Instale as dependências do Vue.js:
`cd ../frontend
npm install
`


6. Inicie o servidor de desenvolvimento do Vue.js:
`npm run serve
`


7. Inicie o Electron:
`npm run electron:serve
`

## Funcionalidades
* Página de Login: Autenticação de usuários.
* Página de Cadastro: Registro de novos usuários.
* Agenda do Psicólogo: Visualização dos próximos atendimentos.
* Administração de Atendimentos pela Secretária: Gerenciamento dos agendamentos.
* Agendamento de Sessões pelos Usuários: Permite aos usuários agendar sessões com os psicólogos.

## Como usar
### Autenticação
* Acesse a página de login e insira suas credenciais.
* Caso não tenha uma conta, utilize a página de cadastro para criar uma.

### Psicólogo
* Acesse a agenda para visualizar os próximos atendimentos.
* Marque atendimentos como concluídos ou cancele-os se necessário.

### Secretária
* Utilize a página de administração para gerenciar os agendamentos.
* Adicione, edite ou remova atendimentos conforme necessário.

### Usuário
* Acesse a página de agendamento para marcar uma sessão com um psicólogo.
* Visualize suas sessões agendadas e cancele se necessário.
