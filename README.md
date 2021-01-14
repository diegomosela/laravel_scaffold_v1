
## Configure

### Database
- **Version:** MySQL 5.7
- **Name:** dbscaffold;
- **File:** ./database/dbscaffold.sql
- **Laravel Migration:** true
---
### Back-end
- **Host:** scaffold.local
- **PHP:** 7.3 >=
---
### Install & Requeriments
#### Requeriments
- Laravel 8.x Server Requeriments https://laravel.com/docs/8.x/installation
- PHP 7.3 >=
- MySQL 5.7 >=
- Composer && php artisan installed
- NPM installed
#### Install
- Clone this repository on a clean folder: https://github.com/matmper/laravel_scaffold_v1
- Use "composer install" on repository folder
- Use "npm install"
- Configure your database and smtp connection on ".env" file (./.env)
- Open your terminal and execute the migration: 	
-- Alternative: import database file in your MySQL database
- Configure a [Sendblue - API KEY v3](https://developers.sendinblue.com/docs/getting-started) to send emails in your .env
###### If you don't find the ".env" file, rename ".env.example" to ".env"
---
#### Seed
- Open your terminal and execute the seed: php artisan db:seed --class=UserSeeder
- Your admin user will be: **admin@admin.com**
- Your admin pass will be: **admin123**
---
- This code cannot be reproduced or used commercially; Only tests and sampling;
---
![May the force be with us](https://media.tenor.com/images/1dc098da87dacc651a0738e2ef66c25f/tenor.gif)

May the force be with us!