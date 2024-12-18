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
```sh
# instalar
composer require spatie/laravel-permission
# publicar
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
# php artisan optimize:clear or php artisan config:clear
php artisan optimize:clear
# atualizar a base de dados: cria a tabela permission, roles e relacionamentos
php artisan migrate

# criar model Role: app/Models/Role.php
php artisan make:model Role
# criar resourse Role: app/Filament/Resources/RolesResource.php
php artisan make:filament-resource Role --generate --simple
```
## Auto-hashing password field
https://filamentphp.com/docs/3.x/forms/advanced#auto-hashing-password-field
```sh
# criar model Permission: app/Models/Permission.php
php artisan make:model Permission
# criar resourse Permission: app/Filament/Resources/PermissionResource.php
php artisan make:filament-resource Permission --generate --simple
```
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
pa make:policy RolePolicy --model=Role
# cria app/Policies/PermissionPolicy.php
pa make:policy PermissionPolicy --model=Permission
# Criar permissions na base de dados
permission_read
permission_create
permission_update
permission_delete
role_read
role_create
role_update
role_delete
# Regra para usuarios
# fn(Builder $query) => auth()->user()->hasRole('Admin) ? null : $query->where('name','!=",'Admin')
# https://filamentphp.com/docs/3.x/panels/resources/getting-started#disabling-global-scopes

# Criar Sedeer
pa make:seeder PermissionSeeder
pa make:seeder RoleSeeder
# php artisan migrate:refresh --seed
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
- [Filament Edit Profile | Filament plugin by joaopaulolndev](https://youtu.be/R526pQZQ5lY?si=OyjUIjE6vDv4PBnL)
```sh
# https://filamentphp.com/docs/3.x/panels/users#customizing-the-authentication-features
# criar página app/Filament/Pages/Auth/EditProfile.php
php artisan make:filament-page Auth/EditProfile
# Filament package to edit profile
# https://github.com/joaopaulolndev/filament-edit-profile
# instalar o plugin: https://filamentphp.com/plugins/joaopaulolndev-edit-profile
composer require joaopaulolndev/filament-edit-profile
# Avatar
php artisan vendor:publish --tag="filament-edit-profile-avatar-migration"
php artisan migrate
php artisan storage:link
# Campos cusmotizados: migrartion
php artisan vendor:publish --tag="filament-edit-profile-custom-field-migration"
php artisan migrate
# config/filament-edit-profile.php
php artisan vendor:publish --tag="filament-edit-profile-config"
# Componentes personalizados: app/Livewire/AddressUserProfile.php
php artisan make:edit-profile-form AddressUserProfile
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
- [activitylog](https://github.com/rmsramos/activitylog)
- [Filament: Spatie/Laravel-activitylog | Filament plugin by rmsramos](https://youtu.be/dOKbc1Tlv7U?si=lZ4gpTwV1jXBXZEw)
- [Activitylog | Filament plugin by rmsramos](https://youtu.be/eNvfz8QMD2g?si=Dzz5zvescsWjwR6o)
```sh
# instalação
composer require rmsramos/activitylog
php artisan activitylog:install
php artisan migrate
# adicionar no Model User:
use LogsActivity;
```
## Endereço
- [Custom Field com Filament v3](https://youtu.be/sCHsGFxWtGY?si=C3LilqHz_BgLQ3Eb)
```sh
# Criar Model e Migration Address: app/Models/Address.php
php artisan make:model Address -m
#  Crar a classe PostalCode: app/Forms/Components/PostalCode.php
php artisan make:form-field PostalCode
# Reverter ultima migração: php artisan migrate rollback