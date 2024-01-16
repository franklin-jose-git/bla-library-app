<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

# BLA Library App
A sample project for demonstrating API CRUD operations using Laravel / PHP.

## Technologies Used
![License: GPL v3](https://img.shields.io/badge/License-GPLv3-blue.svg)![Laravel 10 Logo](https://laravel.com/assets/img/components/logo-laravel.svg)![PHP 8.2 Logo](https://www.php.net//images/logos/php-med-trans-dark.gif)![MySQL 8 Logo](https://www.oracle.com/search/assets/ngui/u15-mysql-logo.png)![Docker](https://1000logos.net/wp-content/uploads/2021/11/Docker-Logo-500x281.png)
- Laravel 10.
- PHP 8.2.12.
- MySQL 8.
- Docker.

# Getting Started

## Prerequisites
- PHP 8.2.12.
- Composer.
- Docker.

## Installation

1. Clone the repository:
```bash
git clone https://github.com/franklin-jose-git/bla-library-app.git
```

2. Change into the project directory:
```bash
cd bla-library-app
```

3. Install composer packages:
```bash
composer install
```

4. Build docker image
```bash
docker-compose build app
```

5. Create docker container
```bash
docker-compose up -d
```

6. Check if the docker containers were created (laravel-app-container, laravel-db-container and laravel-nginx-container)
```bash
docker ps
```

7. When the containers are successfully started, run the following instruction to initiate the database and laravel settings
```bash
docker exec -it laravel-app-container /bin/sh /tmp/init.sh
```

## Usage

1. Use the postman collection already included in the project:
```bash
LibraryApp.postman_collection.json
```

2. The location of the application is inside the following url:
```bash
http://localhost:8000/
```

## Endpoints

| HTTP Verb | Route                     | Description                              |
|-----------|---------------------------|------------------------------------------|
| POST      | api/auth/login            | User login                               |
| POST      | api/auth/logout           | User logout                              |
| GET|HEAD  | api/auth/me               | Get user profile                         |
| GET|HEAD  | api/books                 | Get the list of books                    |
| POST      | api/books                 | Create a new book                        |
| POST      | api/books/search          | Search for books                         |
| GET|HEAD  | api/books/{id}            | Get a book by ID                         |
| PUT       | api/books/{id}            | Update a book by ID                      |
| DELETE    | api/books/{id}            | Delete a book by ID                      |
| GET|HEAD  | api/borrowings            | Get the list of borrowings               |
| POST      | api/borrowings            | Create a new borrowing                   |
| PUT       | api/borrowings/mark/{id}  | Mark a borrowing as delivered            |
| GET|HEAD  | api/borrowings/{id}       | Get a borrowing by ID                    |
| PUT       | api/borrowings/{id}       | Update a borrowing by ID                 |
| DELETE    | api/borrowings/{id}       | Delete a borrowing by ID                 |
| GET|HEAD  | api/dashboard             | Get dashboard data                       |
| GET|HEAD  | api/user                  | Get current user information             |
| GET|HEAD  | api/users                 | Get the list of users                    |
| POST      | api/users                 | Create a new user                        |
| GET|HEAD  | api/users/{id}            | Get a user by ID                         |
| PUT       | api/users/{id}            | Update a user by ID                      |
| DELETE    | api/users/{id}            | Delete a user by ID                      |

Note: all the routes explained before requires authorization as Bearer Token (use `api/auth/login` to get a jwt token)

## License

This project is licensed under the GNU General Public License v3.0. You are free to use, modify, and distribute this software under the terms of the GPL v3.0 license. However, any changes made to the codebase must be shared under the same license

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
