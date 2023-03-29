# Job-Skill-Assessment-Test
Install the following:
php >= 7.3
Apache
Composer

# Steps to setup: #
Step 1: Clone the project

Step 2: Setup configurations
copy .env.example to .env
modify .env with your mysql database host, username, password and database name

Step 3: Go to project directory and install libraries
composer install

Step 4: Setup database. This step will create tables in database
php artisan migrate --seed

Stpe5: Run the project
php artisan serve