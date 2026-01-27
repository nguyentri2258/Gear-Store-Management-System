# Gear Store Management System

## Introduction
Developed a web-based system to help users browse, search, and purchase computer peripherals while assisting store owners in managing products, inventory, and orders efficiently.

## Features

## Tech Stack

Backend:
- Laravel 12.x
- PHP 8.2 (Docker – PHP-FPM)

Frontend:
- Blade Template
- JavaScript
- Vite

Database:
- MySQL 8.0 (Docker)

Web Server:
- Nginx (Docker)

Development Tools:
- Docker & Docker Compose
- phpMyAdmin

## Installation (Docker)
1. Clone the repository:
	```bash
	git clone https://github.com/your-username/your-repo.git
	cd your-repo

2. Create environment file:
	```bash
	cp .env.example .env

3. Build & start Docker containers:
	```bash
	docker compose up -d --build

4. Generate application key:
	```bash
	docker compose exec app php artisan key:generate

5. Run migrations and seeders:
	```bash
	docker compose exec app php artisan migrate:fresh --seed

6. Access the application:

- Web app: http://localhost:8000
- phpMyAdmin: http://localhost:8080

## Database & Seeder

## Roles & Permissions
