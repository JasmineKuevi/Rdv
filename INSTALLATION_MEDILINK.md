# Installation Medilink

## Dependances a installer

- PHP 8.0.2 ou plus recent
- Composer
- Node.js 16 ou plus recent avec npm
- Une base de donnees MySQL/MariaDB, ou SQLite pour tester vite
- Extensions PHP courantes Laravel : openssl, pdo, mbstring, tokenizer, xml, ctype, json, fileinfo, bcmath

## Installation

Depuis ce dossier :

```powershell
cd C:\Users\jasmi\Downloads\rdv-main\rdv-main\APPLI_RDV
composer install
npm install
copy .env.example .env
php artisan key:generate
```

## Configuration base de donnees

Option MySQL :

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=medilink
DB_USERNAME=root
DB_PASSWORD=
```

Option SQLite pour tester rapidement :

```powershell
New-Item database\database.sqlite -ItemType File -Force
```

Puis dans `.env` :

```env
DB_CONNECTION=sqlite
DB_DATABASE=C:\Users\jasmi\Downloads\rdv-main\rdv-main\APPLI_RDV\database\database.sqlite
```

## Lancer le projet

```powershell
php artisan migrate
php artisan db:seed
npm run build
php artisan serve
```

Ouvre ensuite l'URL affichee par Laravel, souvent `http://127.0.0.1:8000`.

## Comptes utiles

Si le seeder admin est utilise, verifie `database/seeders/AdminUserSeeder.php` pour l'email et le mot de passe generes.
