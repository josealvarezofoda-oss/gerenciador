# 🏋️‍♂️ Gerenciador de Academia

**Sistema de gerenciamento de academia** com suporte a diferentes tipos de usuários:

* 👨‍💼 **Admin**: cria, edita e deleta treinos para os alunos.
* 🧑‍🎓 **Aluno**: visualiza seus próprios treinos.

---

## 💻 Tecnologias

* 🛠️ Laravel 12.32.5
* 🖥️ PHP 8.2.12
* 🗄️ MySQL
* 🖼️ Blade (views)

---

## 🚀 Instalação & Setup

### 1️⃣ Clonar o repositório

```bash
git clone <URL_DO_REPOSITORIO>
cd gerenciador
```

---

### 2️⃣ Instalar dependências PHP

```bash
composer install
```

---

### 3️⃣ Instalar dependências JS

```bash
npm install
```

---

### 4️⃣ Configurar `.env`

```bash
cp .env.example .env
```

* Atualize as variáveis do banco de dados:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nome_do_banco
DB_USERNAME=usuario
DB_PASSWORD=senha
```

---

### 5️⃣ Gerar chave do Laravel

```bash
php artisan key:generate
```

---

### 6️⃣ Rodar migrations

```bash
php artisan migrate
```

---

### 7️⃣ Usuário admin de teste

```bash
php artisan tinker
```

No Tinker:

```
O Aluno e Admin de testes já vem criado na seed
```

* 🔑 Login(Admin): `admin@projeto.com` / `12345678`
* 🔑 Login(Aluno): `aluno@projeto.com` / `12345678`

---

## ✅ Uso

1. Logar como **admin** ou **aluno**.
2. Admin pode gerenciar treinos dos alunos.
3. Aluno pode visualizar seus treinos.

---

## ⚠️ Observações

* Middleware `tipo` protege rotas por tipo de usuário.
* Todas as senhas são **hashadas**.
* Se criar novas rotas ou middleware, limpe o cache:

```bash
php artisan route:clear
php artisan cache:clear
php artisan config:clear
composer dump-autoload
```

---