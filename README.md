# Execução Local do Projeto

Este projeto pode ser executado localmente de duas formas: **com Docker** e **sem Docker**.

---

## 1. Executando com Docker

### Pré-requisitos
- [Docker](https://www.docker.com/products/docker-desktop/) instalado

### Passos
1. No diretório raiz do projeto, execute:
   ```sh
   docker compose up --build
   ```
2. Acesse as aplicações:
   - **Backend (Laravel API):** http://localhost:8000
   - **Frontend (Vue.js/Vite/TS):** http://localhost:5173

---

## 2. Executando sem Docker

### Pré-requisitos
- [Node.js](https://nodejs.org/) (v20+) e [npm](https://www.npmjs.com/)
- [PHP](https://www.php.net/) (v8.2+) com [Composer](https://getcomposer.org/)
- [PostgreSQL](https://www.postgresql.org/) (v17+)

### Backend
1. No terminal, acesse a pasta backend:
   ```sh
   cd backend
   ```
2. Instale as dependências PHP:
   ```sh
   composer install
   ```
3. Copie o arquivo de ambiente e ajuste conforme necessário:
   ```sh
   cp .env.example .env
   # Edite o .env para configurar o banco PostgreSQL
   ```
4. Gere a chave da aplicação:
   ```sh
   php artisan key:generate
   ```
5. Execute as migrations:
   ```sh
   php artisan migrate --seed
   ```
6. Crie a secret para o JWT:
   ```sh
   php artisan jwt:key
   ```
7. Inicie o servidor backend:
   ```sh
   php artisan serve
   ```

### Frontend
1. Em outro terminal, acesse a pasta frontend:
   ```sh
   cd frontend
   ```
2. Instale as dependências Node:
   ```sh
   npm install
   ```
3. Inicie o servidor frontend:
   ```sh
   npm run dev
   ```

---

## Observações
- A API estará disponível em http://localhost:8000
- O frontend estará disponível em http://localhost:5173
- Ajuste as variáveis de ambiente conforme necessário para seu ambiente local.
