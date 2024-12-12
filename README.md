# Rodar este projeto
```sh
# editar aruivo env com as credencias do banco de dados
cp .env.example .env
# DB_CONNECTION=mysql
# DB_DATABASE=painel
# DB_USERNAME=root
# DB_PASSWORD=password

# atualizar o composer
composer update
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
```
# Git e Github
```sh
git init
git add .
git commit -m "Video 1 e 2"
git branch -M main
git remote add origin https://github.com/mazera3/painel.git
git push -u origin main
# Atalização
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