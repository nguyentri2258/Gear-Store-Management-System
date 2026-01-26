# Gear Store Management System

## Introduction
Developed a web-based system to help users browse, search, and purchase computer peripherals while assisting store owners in managing products, inventory, and orders efficiently.

## Features

## Tech Stack
Backend:
- Laravel 12.x
- PHP >= 8.2

Database:
- MySQL

Frontend:
- Blade Template
- JavaScript

## Installation
1. Clone the repository:
	```bash
	git clone https://github.com/your-username/your-repo.git
	cd your-repo

2. Install PHP dependencies:
	```bash
	composer install

3. Create environment file and generate app key:
	```bash
	cp .env.example .env
	php artisan key:generate

4. Configure database in .env:
	```bash
	DB_DATABASE=your_database
	DB_USERNAME=your_username
	DB_PASSWORD=your_password

5. Run migrations and seeders:
	```bash
	php artisan migrate:fresh --seed

6. Install and build frontend assets:
	```bash
	npm install
	npm run dev

7. Start the development server:
	```bash
	php artisan serve

## Database & Seeder

## Roles & Permissions
