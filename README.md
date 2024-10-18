# Projet Laravel

## Prérequis

Assurez-vous d'avoir les éléments suivants installés sur votre machine :

- PHP >= 8.0
- Composer
- MySQL (ou tout autre SGBD pris en charge par Laravel)
- Node.js & NPM

## Installation

### 1. Cloner le dépôt

```bash
git clone https://github.com/mitantsoa1/forums.git
cd forums

### 2. Installer les dépendances PHP et JavaScript
composer install
npm install
npm run dev

### 3. Configurer l'environnement
cp .env.example .env
php artisan key:generate

### 4. Configurer la base de données
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=[nom de la base de données]
DB_USERNAME=[votre utilisateur]
DB_PASSWORD=[votre mot de passe]

php artisan migrate

### 5. Lancer l'application
php artisan serve
