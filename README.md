# Projeto de Estudo - Laravel + Filament

Este é um projeto de estudo desenvolvido para aprender e praticar o uso do **Laravel Framework** em conjunto com o **Filament PHP**, um kit de ferramentas para construção de painéis administrativos elegantes e funcionais.

## 🚀 Sobre o Projeto

Este projeto foi criado com fins educacionais para explorar:
- **Laravel 12** - Framework PHP moderno e elegante
- **Filament 4** - Kit de ferramentas para painéis administrativos
- **TailwindCSS 4** - Framework CSS utilitário
- **Vite** - Ferramenta de build rápida

## 📋 Pré-requisitos

Antes de começar, certifique-se de ter instalado:

- **PHP** >= 8.2
- **Composer** (gerenciador de dependências PHP)
- **Node.js** >= 18 (para compilação de assets)
- **NPM** ou **Yarn**
- **Banco de dados** (MySQL, PostgreSQL, SQLite, etc.)

## 🔧 Instalação

Siga os passos abaixo para configurar o projeto:

### 1. Clone o repositório
```bash
git clone <url-do-repositorio>
cd project-filament
```

### 2. Instale as dependências PHP
```bash
composer install
```

### 3. Instale as dependências Node.js
```bash
npm install
```

### 4. Configure o ambiente
```bash
# Copie o arquivo de exemplo
cp .env.example .env

# Gere a chave da aplicação
php artisan key:generate
```

### 5. Configure o banco de dados
Edite o arquivo `.env` e configure as credenciais do banco de dados:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nome_do_banco
DB_USERNAME=usuario
DB_PASSWORD=senha
```

### 6. Execute as migrações
```bash
php artisan migrate
```

### 7. (Opcional) Execute os seeders
```bash
php artisan db:seed
```

## 🚀 Executando o Projeto

### Modo de Desenvolvimento
Para executar o projeto em modo de desenvolvimento:

```bash
# Opção 1: Comando único que inicia servidor, queue e vite
composer dev

# Opção 2: Comandos separados (em terminais diferentes)
php artisan serve
npm run dev
php artisan queue:listen --tries=1
```

O projeto estará disponível em: `http://localhost:8000`

### Modo de Produção
Para compilar os assets para produção:
```bash
npm run build
```

## 🔐 Painel Administrativo (Filament)

O painel administrativo do Filament estará disponível em:
```
http://localhost:8000/admin
```

Para criar um usuário administrador:
```bash
php artisan make:filament-user
```

## 📁 Estrutura do Projeto

```
project-filament/
├── app/                    # Código da aplicação
├── config/                 # Arquivos de configuração
├── database/              # Migrações, seeders e factories
├── public/                # Arquivos públicos
├── resources/             # Views, assets e traduções
├── routes/                # Definições de rotas
├── storage/               # Logs, cache e uploads
├── tests/                 # Testes automatizados
└── vendor/                # Dependências do Composer
```

## 🧪 Executando Testes

Para executar os testes:
```bash
# Executar todos os testes
php artisan test

# Ou usando composer
composer test
```

## 📚 Recursos de Aprendizado

### Laravel
- [Documentação Oficial](https://laravel.com/docs)
- [Laravel Bootcamp](https://bootcamp.laravel.com)
- [Laracasts](https://laracasts.com)

### Filament
- [Documentação do Filament](https://filamentphp.com/docs)
- [Exemplos e Demos](https://demo.filamentphp.com)

## 🛠️ Comandos Úteis

```bash
# Limpar cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Gerar recursos Filament
php artisan make:filament-resource NomeDoModel

# Executar migrações
php artisan migrate
php artisan migrate:rollback

# Executar seeders
php artisan db:seed
php artisan db:seed --class=NomeDoSeeder
```

## 📝 Notas de Estudo

Este projeto serve como laboratório para:
- Compreender a arquitetura MVC do Laravel
- Explorar recursos do Filament como Resources, Forms e Tables
- Praticar desenvolvimento com TailwindCSS
- Implementar autenticação e autorização
- Trabalhar com Eloquent ORM
- Configurar e usar filas (queues)

## 📄 Licença

Este projeto é open-source e está licenciado sob a [Licença MIT](https://opensource.org/licenses/MIT).

## 🤝 Contribuições

Como este é um projeto de estudo, contribuições são bem-vindas! Sinta-se à vontade para:
- Reportar bugs
- Sugerir melhorias
- Adicionar novos recursos
- Compartilhar conhecimento

---

**Desenvolvido para fins educacionais** 📚
