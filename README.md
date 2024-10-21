<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

<p align="center">
  <a href="https://github.com/laravel/framework/actions">
    <img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status">
  </a>
  <a href="https://packagist.org/packages/laravel/framework">
    <img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads">
  </a>
  <a href="https://packagist.org/packages/laravel/framework">
    <img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version">
  </a>
  <a href="https://packagist.org/packages/laravel/framework">
    <img src="https://img.shields.io/packagist/l/laravel/framework" alt="License">
  </a>
</p>

---

# Book and Author Management System

The **Book and Author Management System** is a simple CRUD web application built using Laravel. This project allows users to manage a collection of authors and their books efficiently. It utilizes Laravel's Eloquent ORM to establish and maintain relationships between the two entities—authors and books—making it easy to perform complex operations while keeping the codebase clean and readable.

---
## Goals
1. Implement CRUD functionality for both authors and books.
2. Establish a One-to-Many relationship between authors and books.
3. Create a user-friendly interface for managing books and authors.
4. Ensure proper validation and error handling for all forms.
5. Use Laravel's migration system to maintain database schema.
---

## Key Features

### Authors Management
- Add, update, and delete authors.
- View a list of all authors in the database.

### Books Management
- Add new books and associate them with specific authors.
- Delete books from the system.

### Eloquent Relationships
- **One-to-Many relationship** between authors and books.
- Automatically manage foreign key constraints using Laravel's migrations.

---
## Steps for Development

### 1. Setup Laravel Project
- Install a fresh Laravel project.
- Configure the environment (set up database connection, etc.).
  
### 2. Database Design
- Create the migration for the `authors` table with fields like `id`, `name`.
- Create the migration for the `books` table with fields like `id`, `title`, `author_id`.
- Run the migrations to create tables.

### 3. Model Creation
- Create `Author` and `Book` models.
- Define relationships:
  - An author can have many books (`hasMany` relationship in the `Author` model).
  - A book belongs to one author (`belongsTo` relationship in the `Book` model).

### 4. Controller Development
- Create `AuthorController` to manage all CRUD operations for authors.
- Create `BookController` to handle CRUD operations for books.
  
### 5. Testing
- Test all features (CRUD functionality, form validation, and database interactions) to ensure they work as expected.
- Ensure relationships between authors and books are correctly handled.

---
## Timeline
- **Oct 9,2024** : Project Planning and Project Setup.
- **Oct 10, 2024** : Database design, and migrations.
- **Oct 12, 2024** : Create models, controllers, and routes for basic CRUD.
- **Oct 13,2024** : Fix the error 
- **Oct 16, 2024**: Final testing and preparation for submission.

## Technical Overview

### Routes
The system utilizes Laravel's powerful [Routing Engine](https://laravel.com/docs/routing) to map URLs to the appropriate controllers and actions.

**Example routes:**
- `GET /authors` – List all authors
- `POST /authors` – Create a new author
- `PUT /authors/{id}` – Update an author's details
- `GET /books` – List all books
- `POST /books` – Create a new book with an associated author

### Controllers
The business logic is separated into controllers for clean and maintainable code:
- `AuthorController` manages author-related CRUD operations.
- `BookController` handles all book-related operations.

### Models and Relationships

#### Author Model
Defines the relationship `hasMany` with the `Book` model.

```php
public function books() {
    return $this->hasMany(Book::class);
}
```

#### Book Model
Defines the relationship `belongsTo` with the `Author` model.

```php
public function author() {
    return $this->belongsTo(Author::class);
}
```

#### User Model
The User model extends `Authenticatable` to handle user authentication. It includes properties for managing user data and securely hashing passwords.

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
```


