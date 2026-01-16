# Project Management System

A web-based application and REST API for managing projects and tasks, built with Laravel. The system provides a centralized platform for tracking progress and assigning responsibilities.

## Architecture and Design Patterns

* **Service Layer**: Business logic for projects and tasks is decoupled from controllers and moved into dedicated Service classes. This ensures code reusability across Web and API interfaces and keeps controllers thin.
* **Custom Logging Middleware**: An `ApiLoggerMiddleware` tracks all mutating API requests (POST, PUT, DELETE) and error responses. It logs request metadata, user id, and payloads while filtering out sensitive fields.
* **Form Request Validation**: Data validation is handled via specialized Request classes, ensuring that only sanitized data reaches the service layer.

## Tech Stack
* **PHP**: 8.4
* **Framework**: Laravel 12
* **Database**: MySQL 8.0
* **Frontend**: Bootstrap 5 + Blade
* **Auth**: Sanctum & Web Session
* **Infrastructure**: Docker

## Installation

1.  **Configure environment**:
    ```bash
    cp .env.example .env
    ```

2.  **Build and start containers**:
    ```bash
    docker-compose up -d --build
    ```

3.  **Setup application**:
    ```bash
    docker-compose exec app composer install
    docker-compose exec app php artisan key:generate
    docker-compose exec app php artisan migrate --seed
    ```
    *Seeded credentials: `admin@mail.com` / `Test3000`*

## API Documentation

### Authentication
* `POST /api/register` - Register a new user.
    * **Required:** `name`, `email`, `password`, `password_confirmation`
* `POST /api/login` - Authenticate user and receive a token.
    * **Required:** `email`, `password`

### Projects
* `GET /api/projects` - List all projects. Supports `?search=` for title and description.
* `POST /api/projects/store` - Create new project.
    * **Required:** `title` (string)
    * **Required:** `description` (text)
    * *Note: `user_id` is automatically assigned to the authenticated user.*
* `PUT /api/projects/{id}` - Update project details.
    * **Optional:** `title` (string), `description` (text)
* `DELETE /api/projects/{id}` - Delete project (cascades to all project tasks).

### Tasks
* `GET /api/tasks` - List all tasks. Supports `?search=` for title and description.
* `GET /api/tasks/{id}` - Show detailed task information with relations.
* `POST /api/tasks/store` - Create new task.
    * **Required:** `title` (string)
    * **Required:** `description` (text)
    * **Required:** `project_id` (integer, exists in projects table)
    * **Required:** `assigned_id` (integer, exists in users table)
    * **Optional:** `status` (enum: `todo`, `in_progress`, `done`. Default: `todo`)
* `PUT /api/tasks/{id}` - Update task details.
    * **Optional:** `title`, `description`, `project_id`, `assigned_id`, `status`
* `DELETE /api/tasks/{id}` - Delete task.

## Logging
Detailed logs are stored in `storage/logs/laravel.log`. The system automatically captures API actions including the user context, request method, status code, and input data for audit purposes.
