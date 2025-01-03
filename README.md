# Configurando um Shell Alias
- adicionar esta linha ao arquivo de configuração shell como ~/.bashrc e reinicie o shell.
```sh
# nano ~/.bashrc
alias pa='php artisan'
```
# Rodar este projeto
```sh
# editar aruivo env com as credencias do banco de dados
cp .env.example .env
# DB_CONNECTION=mysql
# DB_DATABASE=painel
# DB_USERNAME="usuario root"
# DB_PASSWORD="senha"

# atualizar o composer
composer update
npm install
# gerar a chave
php artisan key:generate
# migrar a base de dados
php artisan migrate
# rodar o servidor no porta :8000
php artisan serve
# Criar um usuario para acessar o painel
php artisan make:filament-user
# Usuario: Admin
# Email: admin@admin.com
# Senha: 123456
php artisan migrate:refresh --seed
npm run build
```
# Git e Github
```sh
git init
git add .
git commit -m "Video 1 e 2"
git branch -M main
git remote add origin https://github.com/mazera3/painel.git
git push -u origin main
# Descartar mudanças locais e Atualizar
git reset HEAD --hard
git pull origin main
```
# Instalações
## Referencias:
* [Filament](https://filamentphp.com/docs/3.x/panels/installation)
* [Laravel-permission](https://spatie.be/docs/laravel-permission/v6/introduction)
### Vídeos:
1. [Painel Administrativo com Laravel, Filament e Laravel-permission #01](https://youtu.be/sqXaDoGXh6s?si=dP8g_JuN4_ssvQJr)
2. [Painel Administrativo com Laravel, Filament e Laravel-permission #02](https://youtu.be/2luZVm99RgQ?si=TuQHHeELfccEF4hI)
3. [Painel Administrativo com Laravel, Filament e Laravel-permission #03](https://youtu.be/ppBXNFkbXgI?si=Z29vyOctp_LJLv87)
4. [Painel Administrativo com Laravel, Filament e Laravel-permission #04](https://youtu.be/6oABAUbJb6k?si=lecWhft8NTHf8-Qw)
5. [Painel Administrativo com Laravel, Filament e Laravel-permission #05](https://youtu.be/tESj0M8OFiI?si=JojGNRl56kMe2yga)
6. [Painel Administrativo com Laravel, Filament e Laravel-permission #06](https://youtu.be/E9OmVR5rhZ8?si=tcfGo-AbxxZpR5Jx)
7. [Painel Administrativo com Laravel, Filament e Laravel-permission #07](https://youtu.be/zPcuDEskOKk?si=S5WP_E3v3XGPsH5Y)
8. [Painel Administrativo com Laravel, Filament e Laravel-permission #08](https://youtu.be/6eKso342QPA?si=8_5n1BA4UrqzjKjz)
9. [Laravel 11 com Filament (tradução pt-BR)](https://youtu.be/bBoXqX7Zwt4?si=zpnMAjLPyW_dDHLL)
## Instalação do laravel
```sh
laravel new painel
cd painel
```
## Instalação do Filament
```sh
# instalar filament
composer require filament/filament:"^3.2" -W
# instyalar panels
php artisan filament:install --panels
# instalar usuario admin
php artisan make:filament-user
# Usuario: Admin
# Email: admin@admin.com
# Senha: 123456
```
## Criar resource
```sh
# Automatically generating forms and tables
# cria app/Filament/Resources/UserResource.php
php artisan make:filament-resource User --generate
```
## Larevel Permission
- [Laravel-permission](https://spatie.be/docs/laravel-permission/v6/introduction)
- [GitHub](https://github.com/spatie/laravel-permission)
- [Spatie Roles Permissions](https://filamentphp.com/plugins/tharinda-rodrigo-spatie-roles-permissions)
- [GitHub](https://github.com/althinect/filament-spatie-roles-permissions)
- [PlayList](https://www.youtube.com/watch?v=WoHPF2BDcMc&list=PL6tf8fRbavl2oguMj5NSrQXhsd6ztc8_O&index=1)
```sh
# instalar
composer require spatie/laravel-permission
# publicar
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
# php artisan optimize:clear or php artisan config:clear
php artisan optimize:clear
# php artisan config:clear
# atualizar a base de dados: cria a tabela permission, roles e relacionamentos
php artisan db:seed --class=UserSeeder

# criar resourse Role: app/Filament/Resources/RolesResource.php
# use Spatie\Permission\Models\Role;
ph artisan make:filament-resource Role

# criar resourse Permission: app/Filament/Resources/PermissionResource.php
php artisan make:filament-resource Permission --generate
```
## Auto-hashing password field
https://filamentphp.com/docs/3.x/forms/advanced#auto-hashing-password-field

## Integrating with an Eloquent relationship
https://filamentphp.com/docs/3.x/forms/fields/select#integrating-with-an-eloquent-relationship
```sh
# BelongsToMany em UserResource
# Select::make('roles') ->multiple() ->relationship('roles','name')->preload()
# https://spatie.be/docs/laravel-permission/v6/basic-usage/basic-usage
# Models User
use HasRoles
```
## Authorizing access to the panel
https://filamentphp.com/docs/3.x/panels/users#authorizing-access-to-the-panel
```sh
# Models User
class User extends Authenticatable implements FilamentUser

## Vídeos #5 e #6
```
## Generating Policies
```sh
# cria app/Policies/UserPolicy.php
php artisan make:policy UserPolicy --model=User
# cria app/Policies/RolePolicy.php
php artisan make:policy RolePolicy --model=Role
php artisan make:model Role
# cria app/Policies/PermissionPolicy.php
php artisan make:policy PermissionPolicy --model=Permission
php artisan make:model Permission
# cria app/Policies/PostPolicy.php
php artisan make:policy PostPolicy --model=Post
# cria app/Policies/CategoryPolicy.php
php artisan make:policy CategoryPolicy --model=Category
# cria app/Policies/ProjectPolicy.php
php artisan make:policy ProjectPolicy --model=Project
# cria app/Policies/TaskPolicy.php
php artisan make:policy TaskPolicy --model=Task

# Criar Sedeer
pa make:seeder PermissionSeeder
pa make:seeder RoleSeeder
php artisan migrate:refresh --seed
php artisan db:seed --class=UserSeeder

```
# laravel-pt-BR-localization
```sh
# Instalação
# https://github.com/lucascudo/laravel-pt-BR-localization
php artisan lang:publish
# Instale o pacote
composer require lucascudo/laravel-pt-br-localization --dev
# Publique as traduções
php artisan vendor:publish --tag=laravel-pt-br-localization
# altere a linha 8 do arquivo .env
APP_LOCALE=pt_BR
```
# Logos
```sh
# resources/views/filament/logo.blade.php
php artisan make:view filament.logo
# criar tema: resources/css/filament/admin/theme.css 
# e resources/css/filament/admin/tailwind.config.js
php artisan make:filament-theme
npm install
npm run build
```
# Vídeos
- [Filament: Logo / Favicon](https://youtu.be/F-zGGIpxR-Q?si=Wmmt4bcN2Tx63vzz)
- [Perfil de Usuário com Filament V3](https://youtu.be/heu_ZLx7Q34?si=NR54p2GrdovlBRIO)
- [Login / Registro de Usuário com Filament v3](https://youtu.be/SQcXFUmnnsw?si=T6Mo3RtL-Lpjjz8J)
```sh
# https://filamentphp.com/docs/3.x/panels/users#customizing-the-authentication-features
# criar página app/Filament/Pages/Auth/EditProfile.php
php artisan make:filament-page Auth/EditProfile
php artisan make:filament-page Auth/Register
php artisan make:filament-page Auth/Login


php artisan storage:link
```
## Notificações
- [Filament: Enviado notificações com databaseNotifications](https://youtu.be/wReE56xivg0?si=ror9JuYqbNDxDL43)
```sh
# https://filamentphp.com/docs/3.x/notifications/database-notifications
php artisan make:notifications-table
php artisan migrate
# Observer: app/Observers/UserObserver.php
php artisan make:observer UserObserver --model=User
```
## Logs
- [Laravel-activitylog](https://spatie.be/docs/laravel-activitylog/v4/installation-and-setup)
```sh
# instalação
composer require spatie/laravel-activitylog
# Migração
php artisan vendor:publish --provider="Spatie\Activitylog\ActivitylogServiceProvider" --tag="activitylog-migrations"
php artisan migrate
```
## Endereço
- [Custom Field com Filament v3](https://youtu.be/sCHsGFxWtGY?si=C3LilqHz_BgLQ3Eb)
```sh
# Criar Model e Migration Address: app/Models/Address.php
php artisan make:model Address -m
#  Crar a classe PostalCode: app/Forms/Components/PostalCode.php
php artisan make:form-field PostalCode
# Reverter ultima migração: php artisan migrate rollback
php artisan migrate:rollback --step=1
```
## Avatar
- [FilamentPHP na Prática / 14 - Upload de Fotos no FilamentPHP]()https://youtu.be/aN0Gb1r3J14?si=Mtf-FCBZ11gezvOw
```sh
# php artisan make:migration add_(campo)_to_(nome_da_tabela)_table --table=(tabela)
php artisan migrate
php artisan storage:link
# visão geral conveniente de todos os atributos e relações do modelo
php artisan model:show User
```
## Implementação de Projetos e Tarefas
- [filament-br](https://github.com/mazera3/filament-br)

## Implementação de Posts, Categories e PhoneNumber
- [HasMany](https://github.com/mazera3/Relacionamento-HasMany.git)

## Implementar Widgets
- [Filament Widgets](https://filamentphp.com/docs/3.x/widgets/installation)
- [Vídeo](https://youtu.be/lBOQnPUWyZ0?si=BpJy9DNLwnxTnYul)
How to Create a Dashboard Using Stats, Widgets & Tables in FilamentPHP - FilamentPHP for Beginners.
```sh
php artisan filament:install --widgets
npm install tailwindcss @tailwindcss/forms @tailwindcss/typography postcss postcss-nesting autoprefixer --save-dev
# Criar um novo tailwind.config.js na para resource/css/filament
```
![tailwind.config.js](figuras/image01.png)
```sh
# Adicionar as camadas CSS do Tailwind ao resources/css/app.css
```
![app.css](figuras/image02.png)
```sh
# Criar o arquivo postcss.config.js na raiz seu projeto
```
![postcss.config.js](figuras/image03.png)
```sh
# atualizar o vite.config.js
# Compile novos ativos CSS e Javascript
npm run dev
# Criar um novo arquivo de layout resources/views/components/layouts/app.blade.php
# publicar a configuração do pacote
php artisan vendor:publish --tag=filament-config
composer update
php artisan filament:upgrade
# criando um widget de estartiscas gerais
php artisan make:filament-widget StatsOverview --stats-overview
# Widgets de gráfico de usuarios
php artisan make:filament-widget UserChart --chart // Line Chart
# Widgets de tabela de usuarios
php artisan make:filament-widget UserTable --table // Line Table

```
## Laravel Trend
- [Github](https://github.com/Flowframe/laravel-trend)
```sh
composer require flowframe/laravel-trend
```
## Exportar com CSV ou XLSX
- [Filament Actions](https://filamentphp.com/docs/3.x/actions/prebuilt-actions/export)
```sh
# Instalação
php artisan make:queue-batches-table
php artisan vendor:publish --tag=filament-actions-migrations
php artisan migrate
# Criar uma classe de exportador para a model User
php artisan make:filament-exporter User --generate
```
## Importar CSV
```sh
# Criar uma classe de importador para a model User
php artisan make:filament-importer User --generate
```

# Laravel Blade
- https://kinsta.com/pt/blog/laravel-blade/
## Layout
```sh
# Criar um layout: resources/views/components/layout.blade.php
php artisan make:component Layout