# Code-Blue
"CSMC 128.1 Code Blue Project: Health record software for resuscitation scenarios. Enhances accessibility to critical patient information during emergencies, optimizing resuscitation efforts."

## Program Setup
### Local version
Source Code:
1. Open source code in any code editor
2. Locate file named “ .env”
3. Change:
    * APP_URL  to “http://localhost”
    * APP_ENV to “local”
    * DB_DATABASE to “codeblue”
    * DB_USERNAME to your pgadmin username (e.g. postgres)
    * DB_PASSWORD to your pgadmin password (e.g. password)

## PostgreSQL
Create database named “codeblue”

## Computer Terminal
Type the following commands:
1. “composer update”
2. “npm install”
3. “php artisan migrate”
4. “php artisan db:seed”
5. “php artisan serve”
6. Run -> click this link in terminal “http://127.0.0.1:8000”

## Log-in details
* Email: admin123
* Password: codeblue128.1
