# BarberGest

Sistema simples de gestão para barbearias, focado em **controle de atendimentos, clientes e caixa diário**.

---

## 📌 Descrição do Projeto

O **BarberGest** é um sistema de gestão desenvolvido em **Laravel** para barbearias que precisam:

* Controlar clientes
* Registrar atendimentos
* Saber quanto entrou por dia ou por período
* Visualizar relatórios simples
* Trabalhar localmente (sem custos de hospedagem inicial)

Projeto ideal para **uso real** e também como base para evolução futura.

---

## 🚀 Funcionalidades

* Autenticação (Administrador)
* Gestão de Clientes
* Gestão de Serviços (preço editável)
* Registo de Atendimentos
* Caixa diário e mensal
* Relatórios com filtro por data
* Impressão de relatórios
* Dashboard com métricas e gráfico

---

## 🛠️ Tecnologias Utilizadas

* PHP 8+
* Laravel
* Laravel Breeze
* Blade
* Tailwind CSS
* MySQL
* Chart.js
* Laragon (ambiente local)

---

## ⚙️ Instalação e Configuração (Local)

Siga os passos abaixo para configurar o BarberGest no seu ambiente local:

```bash
# Clonar o repositório
git clone https://github.com/jobil05soft/barbergest.git
cd barbergest

# Instalar dependências PHP
composer install

# Criar o arquivo de ambiente
cp .env.example .env

# Gerar a chave da aplicação
php artisan key:generate

# Rodar migrations e seeders (cria admin e dados iniciais)
php artisan migrate --seed

# Instalar dependências front-end
npm install

# Compilar arquivos para produção (Tailwind/Vite)
npm run build

# Rodar o servidor local
php artisan serve
```

> Após isso, acesse `http://localhost:8000` e use o usuário admin criado pelo seeder.

---

## 🔐 Usuário Admin Padrão (Seed)

* Email: admin@barbergest.local
* Senha: 12345678

> Lembre-se de alterar a senha após o primeiro login.

---

## 📄 Licença

Este projeto é de uso livre para fins educacionais e comerciais.

---

## 👤 Autor

Desenvolvido por **Jobil Manuel**
Projeto MVP com foco em soluções reais para pequenos negócios.
