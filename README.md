# Plataforma de Planejamento de Viagens em Grupo
Bem-vindo ao Planejador Simplificado de Viagens em Grupo! Esta é uma aplicação leve para ajudar grupos de amigos, familiares ou colegas a organizarem uma viagem de forma simples e prática, com funcionalidades essenciais para planejamento colaborativo.
# Proposta
O Planejador de Viagens em Grupo foi projetado para facilitar o planejamento de viagens em grupo com o mínimo de complexidade. Ele oferece uma interface onde os usuários podem criar um roteiro, definir orçamento e dividir despesas de forma básica, sem recursos adicionais que possam tornar o processo confuso.
# Recursos Principais
1 - Criação de Viagem em Grupo:
  - Usuários podem criar uma viagem em grupo.

2 - Roteiro Básico:
  - Possibilidade de criar um roteiro diário com atividades e destinos.

3 - Orçamento e Divisão de Custos:
  - Uma calculadora simples de orçamento onde os custos da viagem podem ser adicionados e automaticamente divididos entre os membros.

4 - Lista de Tarefas para o Grupo:
  - Lista de tarefas para ajudar na organização de responsabilidades, como reservar hotel, comprar ingressos, entre outras atividades importantes.
# Público-Alvo
Esta aplicação é ideal para grupos que precisam de uma ferramenta simples para:

  - Planejar viagens de fim de semana.
  - Organizar escapadas de última hora.
  - Planejar eventos de pequeno porte, como passeios ou viagens de família.

# Tecnologias Utilizadas
Para manter o projeto leve e de fácil manutenção, utilizamos as seguintes tecnologias:

  - Back-end: PHP puro para gerenciar a criação de viagens, o roteiro e as despesas de forma centralizada.
  - Front-end: Bootstrap para estilização básica.
  - Banco de Dados: MySQL ou PostgreSQL para armazenar dados das viagens, usuários e despesas.

# Dependências
Verifique se o ambiente possui as seguintes dependências instaladas:

  - PHP 7.4 ou superior.
  - Banco de Dados MySQL ou PostgreSQL.
  - Bootstrap: para uma interface intuitiva e responsiva.

# Diagrama
![Planejamento-de-Viagens drawio](https://github.com/user-attachments/assets/d54ce8ce-9c36-4b31-bead-3a7faf51f296)

# ROTAS

$router->add('GET', '/trips', [$tripController, 'list']);
$router->add('GET', '/trips/{id}', [$tripController, 'getById']);
$router->add('POST', '/trips', [$tripController, 'create']);
$router->add('DELETE', '/trips/{id}', [$tripController, 'delete']);
$router->add('PUT', '/trips/{id}', [$tripController, 'update']);

$router->add('GET', '/expenses', [$expenseController, 'list']);
$router->add('GET', '/expenses/{id}', [$expenseController, 'getById']);
$router->add('POST', '/expenses', [$expenseController, 'create']);
$router->add('DELETE', '/expenses/{id}', [$expenseController, 'delete']);
$router->add('PUT', '/expenses/{id}', [$expenseController, 'update']);
