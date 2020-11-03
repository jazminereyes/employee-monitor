## Getting Started

Please check the official laravel installation guide for server requirements before you start.[Official Documentation](https://laravel.com/docs/5.4/installation#installation)

Clone the repository
```
git clone https://gitlab.com/fourptzero/employee_monitoring.git
```

Switch to the project folder
```
cd employee_monitoring
```

Install the project dependencies using Composer
```
composer install
```

Copy the example env file and make the required configuration changes in the .env file
```
cp .env.example .env
```

Generate a new application key
```
php artisan key:generate
```

Run the database migrations **(Set the database connection in .env before migrating)**
```
php artisan migrate
```

Start the local development server
```
php artisan serve
```

### Database Seeding
Run the seeder to seed test data
```
php artisan db:seed
```
