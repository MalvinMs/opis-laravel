# Laravel JSON Schema Validator

A Laravel application for managing and validating JSON schemas with dynamic form validation using Opis JSON Schema.

## 📋 Overview

This project provides a robust API for creating, managing, and validating data against JSON Schema definitions. It includes both API endpoints and a Filament admin panel for easy schema management.

## ✨ Features

-   **JSON Schema Management**: Create, read, and manage JSON Schema templates
-   **Dynamic Form Validation**: Validate form submissions against stored schemas
-   **Opis JSON Schema Integration**: Powerful validation using Opis JSON Schema library
-   **Filament Admin Panel**: User-friendly interface for schema management
-   **RESTful API**: Well-structured API endpoints with proper error handling
-   **Comprehensive Validation**: Support for JSON Schema draft-06 and draft-07
-   **Automatic API Documentation**: Integrated with Scramble for API documentation

## 🚀 Tech Stack

-   **Framework**: Laravel 12.x
-   **PHP**: 8.2+
-   **Admin Panel**: Filament 4.0
-   **JSON Schema Validation**: Opis JSON Schema 2.6
-   **API Documentation**: Scramble
-   **Database**: MySQL/PostgreSQL/SQLite

## 📦 Installation

### Prerequisites

-   PHP 8.2 or higher
-   Composer
-   Node.js & NPM
-   MySQL/PostgreSQL/SQLite

### Setup Steps

1. **Clone the repository**

    ```bash
    git clone https://github.com/MalvinMs/opis-laravel.git
    cd opis-laravel
    ```

2. **Install dependencies**

    ```bash
    composer install
    npm install
    ```

3. **Environment setup**

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4. **Configure database**

    Update your `.env` file with database credentials:

    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database
    DB_USERNAME=your_username
    DB_PASSWORD=your_password
    ```

5. **Run migrations**

    ```bash
    php artisan migrate
    ```

6. **Build assets**

    ```bash
    npm run build
    ```

7. **Start the development server**
    ```bash
    php artisan serve
    ```

## 🔌 API Endpoints

### JSON Schema Endpoints

#### Get All Schemas

```http
GET /api/json-schemas
```

**Response:**

```json
[
    {
        "id": 1,
        "name": "User Registration Schema",
        "schema": { ... },
        "created_at": "2025-11-24T01:22:59.000000Z",
        "updated_at": "2025-11-24T01:22:59.000000Z"
    }
]
```

#### Create Schema

```http
POST /api/json-schemas
Content-Type: application/json
```

**Request Body:**

```json
{
    "name": "Contact Form Schema",
    "schema": {
        "$schema": "http://json-schema.org/draft-07/schema#",
        "type": "object",
        "properties": {
            "email": {
                "type": "string",
                "format": "email"
            },
            "name": {
                "type": "string",
                "minLength": 3
            }
        },
        "required": ["email", "name"]
    }
}
```

**Response (201 Created):**

```json
{
    "success": true,
    "message": "JSON Schema created successfully",
    "data": { ... }
}
```

### Form Endpoints

#### Get All Forms

```http
GET /api/forms
```

#### Submit Form with Validation

```http
POST /api/forms/{templateId}
Content-Type: application/json
```

**Request Body:**

```json
{
    "data": {
        "email": "user@example.com",
        "name": "John Doe"
    }
}
```

**Response (201 Created):**

```json
{
    "success": true,
    "message": "Form created successfully",
    "data": { ... }
}
```

**Validation Error Response (422):**

```json
{
    "success": false,
    "message": "Validation failed",
    "errors": {
        "data": [
            "Validasi gagal pada email: The data must match the type string"
        ]
    }
}
```

## 📖 Usage Examples

### Example 1: User Registration Schema

**Create Schema:**

```bash
curl -X POST http://localhost:8000/api/json-schemas \
  -H "Content-Type: application/json" \
  -d '{
    "name": "User Registration",
    "schema": {
      "type": "object",
      "properties": {
        "username": {
          "type": "string",
          "minLength": 3,
          "maxLength": 50
        },
        "email": {
          "type": "string",
          "format": "email"
        },
        "password": {
          "type": "string",
          "minLength": 8
        }
      },
      "required": ["username", "email", "password"]
    }
  }'
```

**Submit Valid Form:**

```bash
curl -X POST http://localhost:8000/api/forms/1 \
  -H "Content-Type: application/json" \
  -d '{
    "data": {
      "username": "johndoe",
      "email": "john@example.com",
      "password": "securepass123"
    }
  }'
```

### Example 2: Contact Form Schema

```json
{
    "name": "Contact Request Form",
    "schema": {
        "type": "object",
        "properties": {
            "fullName": {
                "type": "string",
                "minLength": 3
            },
            "email": {
                "type": "string",
                "format": "email"
            },
            "phone": {
                "type": "string",
                "minLength": 10
            },
            "message": {
                "type": "string",
                "minLength": 10
            }
        },
        "required": ["fullName", "email", "message"]
    }
}
```

## 🛠️ Development

### Running Tests

```bash
php artisan test
```

### Code Style

```bash
./vendor/bin/pint
```

### Access Filament Admin Panel

```
http://localhost:8000/admin
```

## 📚 Documentation

-   [Opis JSON Schema Documentation](https://opis.io/json-schema/)
-   [Laravel Documentation](https://laravel.com/docs)
-   [Filament Documentation](https://filamentphp.com/docs)

## 🔐 Schema Support

This application supports **JSON Schema Draft-06 and Draft-07**.

> **Note:** While the Opis library v2.6 officially supports draft-06 and draft-07, schemas using later drafts (2019-09, 2020-12) may work if they don't use unsupported features. For best compatibility, use draft-07.

**Recommended Schema Declaration:**

```json
{
    "$schema": "http://json-schema.org/draft-07/schema#",
    "type": "object",
    ...
}
```

## 🤝 Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## 📝 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
