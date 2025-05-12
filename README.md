
# PhysioMobile API

PhysioMobile API is a RESTful backend built with Laravel, designed to support digital physiotherapy services. This application provides features such as user management, service booking, and payment integration.

## Key Features

- User management with authentication and authorization.
- Online physiotherapy service booking.
- Integration with payment systems.
- Admin dashboard for data management and reporting.

## Technologies Used

- PHP 8.x
- Laravel 10.x
- PostgresQL
- Laravel Sail (Docker-based local development environment)
- Vite.js for frontend asset management
- Blade as the template engine

## Installation

1. **Clone the repository:**

   ```bash
   git clone https://github.com/humamalamin/api-physiomobile.git
   cd api-physiomobile
   ```

2. **Copy the `.env` file and adjust configurations:**

   ```bash
   cp .env.example .env
   ```

3. **Install dependencies using Composer:**

   ```bash
   composer install
   ```

4. **Start Laravel Sail:**

   ```bash
   ./vendor/bin/sail up -d
   ```

   > If this is your first time using Sail, you may need to run:
   > ```bash
   > php artisan sail:install
   > ```

5. **Generate application key:**

   ```bash
   ./vendor/bin/sail artisan key:generate
   ```

6. **Run migrations and seeders (if available):**

   ```bash
   ./vendor/bin/sail artisan migrate --seed
   ```


6. **Install laravel octane:**

   ```bash
   ./vendor/bin/sail artisan octane:install --server=frankenphp
   ```

## Directory Structure

- `app/` – Contains application logic and models.
- `routes/` – Contains API route definitions.
- `resources/` – Contains Blade templates and frontend assets.
- `database/` – Contains migrations and seeders.
- `config/` – Contains application configuration files.

## Testing

To run tests:

```bash
./vendor/bin/sail artisan test
```

## Contributing

Contributions are welcome! Feel free to fork this repository and create a pull request for improvements or new features.

## License

This project is licensed under the [MIT License](LICENSE).
