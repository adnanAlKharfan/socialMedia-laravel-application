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

### Entity-Relationship Diagram (ERD)

users

- id: Primary Key (PK)
- role_id: Foreign Key (FK) reference to roles table
- photo_id: Nullable
- name
- email: Unique
- password
- rememberToken
- created_at
- updated_at

posts

- id: Primary Key (PK)
- user_id: Foreign Key (FK) reference to users table
- category_id: Foreign Key (FK) reference to categories table
- photo_id
- title
- slug: Nullable
- body
- created_at
- updated_at

roles

- id: Primary Key (PK)
- name: Unique
- created_at
- updated_at

categories

- id: Primary Key (PK)
- name
- created_at
- updated_at

comments

- id: Primary Key (PK)
- post_id: Foreign Key (FK) reference to posts table
- author
- photo
- email
- body
- created_at
- updated_at


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
