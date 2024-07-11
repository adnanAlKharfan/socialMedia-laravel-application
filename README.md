# Social Media Website

This repository contains a full stack social media application made using laravel and bootstrap.

## Introduction

Our social media application allows users to post and comment on other user post, categories their posts and filter what posts they like to see on any available category.

## Features

- Authentication

- User Roles

- Allowing users to post, delete and edit their post

- Allowing users to add, delete and edit their comments on any post they commented on

- Allowing admin to fully control users account

- Allowing admin to create new categories and edit existing ones


## Database

Our database consists of 5 tables: users, posts, roles, categories and comments.

+--------------+
|    users     |
+--------------+
| id           | (PK)
| role_id      |
| photo_id     |
| name         |
| email        |
| password     |
| rememberToken|
| created_at   |
| updated_at   |
+--------------+

+--------------+
|    posts     |
+--------------+
| id           | (PK)
| user_id      | (FK -> users.id)
| category_id  | (FK -> categories.id)
| photo_id     |
| title        |
| slug         |
| body         |
| created_at   |
| updated_at   |
+--------------+

+--------------+
|    roles     |
+--------------+
| id           | (PK)
| name         |
| created_at   |
| updated_at   |
+--------------+

+--------------+
| categories   |
+--------------+
| id           | (PK)
| name         |
| created_at   |
| updated_at   |
+--------------+

+--------------+
|  comments    |
+--------------+
| id           | (PK)
| post_id      | (FK -> posts.id)
| author       |
| photo        |
| email        |
| body         |
| created_at   |
| updated_at   |
+--------------+


In this schema:

- Each user can have multiple posts.
- Each post belongs to a user and a category.
- Each comment is associated with a specific post.
- Each user has a role.


## Installation


### Prerequisites

- PHP>=7.0

- Composer

- MySql

### Steps

1. Install PHP dependencies:
```
Composer install
```

2. Migrate the database:
```
php artisan migrate:refresh
```

3. Seed the database:
```
php artisan db:seed
```

4. Run the server:
```
php artisan serve
```

5. Navigate to [local host](http://localhost:8080) and sign in with this credential email: `adnan@adnan.com` and password: `test123`

## Contributing

Contributions are welcome! Please fork this repository and submit a pull request.
