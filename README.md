Laravel Project
This repository contains a Laravel application. The instructions below will guide you through the setup and installation process.

Table of Contents
Requirements
Installation
Configuration
Database Migration & Seeding
Running the Application
Testing
Troubleshooting
License
Requirements
Before installing, ensure you have the following installed on your local machine:

PHP 8.1 or higher
Composer
Node.js & npm
MySQL/MariaDB or any other supported database
Installation
Clone the Repository:

bash
Copy code
git clone https://github.com/harp-eng/ims.git
cd your-repository
Install PHP Dependencies:

Install the PHP dependencies using Composer:

bash
Copy code
composer install
Install JavaScript Dependencies:

Install the front-end dependencies using npm:

bash
Copy code
npm install
Generate Application Key:

Run the following command to generate the application key:

bash
Copy code
php artisan key:generate
Configuration
Copy the .env.example file to .env:

bash
Copy code
cp .env.example .env
Set Environment Variables:

Update the .env file with your database credentials and other environment settings:

env
Copy code
APP_NAME=LaravelApp
APP_ENV=local
APP_KEY=base64:YOUR_APP_KEY
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password
Configure File Permissions:

Ensure that the storage and bootstrap/cache directories are writable by your web server:

bash
Copy code
sudo chmod -R 775 storage
sudo chmod -R 775 bootstrap/cache
Database Migration & Seeding
Run Migrations:

Run the following command to migrate the database schema:

bash
Copy code
php artisan migrate
Run Seeders (Optional):

If your project includes seeders to populate the database with sample data, run:

bash
Copy code
php artisan db:seed
Running the Application
Build the Front-End Assets:

Compile the front-end assets (CSS, JS) using:

bash
Copy code
npm run dev
For production, use:

bash
Copy code
npm run build
Start the Local Development Server:

Use the Artisan command to start a local server:

bash
Copy code
php artisan serve
By default, the application will be available at http://localhost:8000.

Testing
Laravel provides a robust testing suite. To run the tests, use:

bash
Copy code
php artisan test
Troubleshooting
If you encounter any issues during installation or while running the application, check the following:

Ensure that the .env file is configured correctly.
Verify that your PHP, Composer, and npm versions meet the requirements.
Check the storage/logs/laravel.log file for errors.
License
This project is licensed under the MIT License. See the LICENSE file for more details.
