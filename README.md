# Laravel Portfolio Website (v2.0)

This repository contains the second version of my personal portfolio website, rebuilt from the ground up using the Laravel framework. This project serves as a showcase for my skills in modern, professional-grade web development practices.

The original vanilla PHP version of this site is preserved on the `v1` branch.

## Core Technologies

- **Backend:** Laravel 12, PHP 8.2+
    
- **Frontend:** SCSS, Vite, Alpine.js
    
- **Database:** SQLite (for local development)
    
- **Authentication:** Laravel Breeze
    

## Features

- **Database-Driven Content:** All portfolio content (employment, education, projects) is managed in a database and accessed via Laravel's Eloquent ORM.
    
- **Secure Admin Dashboard:** A fully functional, password-protected admin area for CRUD (Create, Read, Update, Delete) operations on all portfolio content.
    
- **Custom Blade Components:** Utilizes reusable Blade components for UI elements like the navigation menu and modal dialogs.
    
- **Live Code Embedding:** Project detail pages can fetch and display code directly from GitHub repositories using a custom JavaScript function and the Prism.js library.
    
- **Professional Tooling:** Uses Composer for package management and Vite for compiling front-end assets.
    

## Getting Started (Local Development)

### Prerequisites

- PHP 8.2+
    
- Composer
    
- Node.js & npm
    
- A local database (the project is configured for SQLite by default)
    

### Installation

1. Clone the repository:
    
    ```
    git clone [https://github.com/raggiesoft/michaelpragsdale.com.git](https://github.com/raggiesoft/michaelpragsdale.com.git)
    cd michaelpragsdale.com
    git checkout v2-laravel
    ```
    
2. Install PHP dependencies:
    
    ```
    composer install
    ```
    
3. Install NPM dependencies:
    
    ```
    npm install
    ```
    
4. Create your local environment file:
    
    ```
    cp .env.example .env
    ```
    
5. Generate an application key:
    
    ```
    php artisan key:generate
    ```
    
6. Create the SQLite database file:
    
    ```
    touch database/database.sqlite
    ```
    
7. Run the database migrations and seed the initial data:
    
    ```
    php artisan migrate --seed
    ```
    

### Running the Development Servers

You need to run two servers in two separate terminals:

**Terminal 1 (PHP Server):**

```
php artisan serve
```

**Terminal 2 (Vite Server):**

```
npm run dev
```

You can now access the site at `http://127.0.0.1:8000`.

## License

This project is licensed under the **GNU General Public License v3.0**.
