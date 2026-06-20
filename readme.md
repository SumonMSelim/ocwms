# Open Courseware Management System

Open Courseware (OCW) Management System provides a web platform for courses of study. Faculty can manage course materials online so students can access lectures and assignments, submit work, and view grades.

Built with **Laravel 13** and **PHP 8.3+** (PHP 8.4 recommended).

## Features

- Faculty and student registration and login
- Course, lecture, and assignment management
- Student enrollment and assignment submission
- Faculty grading and progress tracking

## Requirements

- Docker and Docker Compose (recommended)
- Or PHP 8.3+, Composer, and MySQL 8

## Installation (Docker)

1. Clone the repository:

```bash
git clone <repository-url> ocwms
cd ocwms
```

2. Copy the environment file and install dependencies:

```bash
cp .env.example .env
docker compose run --rm app composer install
```

3. Start the containers:

```bash
docker compose up -d --build
```

4. Generate an application key and run migrations:

```bash
docker compose exec app php artisan key:generate
docker compose exec app php artisan migrate
```

5. Open the application at [http://localhost:8095](http://localhost:8095).

## Running locally (Docker)

```bash
docker compose up -d
```

Stop the stack:

```bash
docker compose down
```

Run tests inside Docker:

```bash
docker compose exec app php artisan test
```

## Installation (without Docker)

1. Install PHP 8.3+ extensions: `mbstring`, `pdo_mysql`, `zip`, `openssl`.

2. Install dependencies and configure the app:

```bash
composer install
cp .env.example .env
php artisan key:generate
```

3. Set database credentials in `.env` and run migrations:

```bash
php artisan migrate
```

4. Start the development server:

```bash
php artisan serve
```

Visit [http://localhost:8000](http://localhost:8000).

## Running tests

```bash
php artisan test
```

Tests use an in-memory SQLite database (configured in `phpunit.xml`).

## Project structure

| Path | Description |
|------|-------------|
| `app/Http/Controllers` | Faculty, student, and home controllers |
| `app/Models` | Eloquent models |
| `resources/views` | Blade templates |
| `public/uploads` | Uploaded lecture, assignment, and solution files |
| `docker-compose.yml` | Local Docker stack (nginx, PHP-FPM, MySQL) |

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
