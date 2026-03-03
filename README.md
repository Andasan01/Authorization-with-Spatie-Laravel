# Laravel API Projects - Activities 1, 2, 3 & 4

---

## 📋 Project Activities Overview

### ✅ ACTIVITY 2: Student CRUD API (Legacy)
A legacy REST API for managing student records with basic CRUD operations.

**Functions & Description:**
- Create new student records
- Read/Retrieve student data
- Update existing student information
- Delete student records
- Basic validation and data persistence
- MySQL database integration

---

### ✅ ACTIVITY 3: Laravel Sanctum Authentication API

A fully functional Authentication API built with Laravel Sanctum featuring token-based authentication with secure user management.

**Functions & Description:**
- **User Registration** - Register new users with validation (email, password)
- **User Login** - Authenticate users and generate secure Bearer tokens
- **Protected Routes** - Secure API endpoints using token-based authentication
- **Get Authenticated User Data** - Retrieve current user information
- **Single Device Logout** - Invalidate current session token
- **Multi-Device Logout** - Invalidate all session tokens for a user
- **Token Expiration** - Automatic token expiration after 7 days
- **MySQL Database Persistence** - Secure user data storage

**🚀 API Endpoints:**

| Method | Endpoint | Description | Auth Required |
|--------|----------|-------------|---------------|
| POST | `/api/register` | Register new user with validation | No |
| POST | `/api/login` | Login & get authentication token | No |
| GET | `/api/test` | Test API connectivity | No |
| GET | `/api/user` | Get authenticated user data | Yes |
| POST | `/api/logout` | Logout from current device | Yes |
| POST | `/api/logout-all` | Logout from all devices | Yes |

---

### ✅ Activity 4: Authorization with Spatie Laravel Permissions

Advanced role-based access control (RBAC) system using Spatie Laravel Permissions package for granular authorization management.

**Functions & Description:**
- **Role Management** - Create and manage user roles (Admin, Editor, Viewer, etc.)
- **Permission Management** - Define granular permissions for different actions
- **Role Assignment** - Assign roles to users
- **Permission Assignment** - Assign specific permissions to roles and users
- **Access Control** - Check user permissions and roles before granting access
- **Protected Routes** - Secure endpoints based on user roles and permissions
- **Permission Tables** - Database tables for roles, permissions, and model associations
- **Dynamic Authorization** - Flexible permission checking for API endpoints

**Key Features:**
- Spatie Laravel Permissions package integration
- Role-based middleware for route protection
- Permission checking in controllers
- Database-driven role and permission management
- Support for role and permission assignment to users

---

## � Technologies Used

### Backend Technologies
- **PHP 8.2+** - Server-side programming language
- **Laravel 12** - Modern PHP web framework
- **Laravel Sanctum 4.3** - Token-based API authentication system
- **Spatie Laravel Permissions 6.24** - Role-based access control (RBAC) package
- **MySQL** - Relational database management system
- **Laravel Tinker** - Interactive REPL for Laravel

### Frontend Technologies
- **Vite 7.0** - Next-generation frontend build tool
- **TailwindCSS 4.0** - Utility-first CSS framework
- **Axios 1.11** - Promise-based HTTP client for API requests
- **Laravel Vite Plugin** - Laravel integration for Vite

### Development & Testing Tools
- **PHPUnit 11.5** - Server-side testing framework
- **Laravel Pint 1.24** - Code style fixing tool
- **Laravel Sail** - Light-weight Docker development environment
- **Laravel Pail** - Real-time log monitoring
- **FakerPHP 1.23** - Generate fake data for testing
- **Mockery 1.6** - Mock object library for testing
- **Concurrently** - Run multiple commands simultaneously

### Deployment & Package Management
- **Composer** - PHP dependency manager
- **npm** - JavaScript package manager
- **XAMPP** - Local development server (Apache, MySQL, PHP)

---

## 🛠️ Installation & Setup

### Prerequisites
- PHP 8.2 or higher
- Composer (PHP dependency manager)
- Node.js & npm (JavaScript package manager)
- MySQL 8.0 or higher
- XAMPP (or Apache, MySQL, PHP separately)
- Git

### Step-by-Step Installation

#### 1. Clone the Repository
```bash
git clone <repository-url>
cd Authorization-Sanctum-api
```

#### 2. Install PHP Dependencies
```bash
composer install
```

#### 3. Environment Configuration
```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env` file and configure:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=authorization_api
DB_USERNAME=root
DB_PASSWORD=

APP_NAME="Authorization API"
APP_URL=http://localhost:8000
```

#### 4. Create Database
```bash
# Option 1: Using MySQL CLI
mysql -u root -p
CREATE DATABASE authorization_api;

# Option 2: Using phpMyAdmin (XAMPP)
# Access http://localhost/phpmyadmin
```

#### 5. Run Database Migrations
```bash
php artisan migrate
```

#### 6. Seed Database (Optional - for testing data)
```bash
php artisan db:seed
```

#### 7. Install JavaScript Dependencies
```bash
npm install
```

#### 8. Build Frontend Assets
```bash
npm run build
```

#### 9. Start Development Server
```bash
php artisan serve
```

The API will be available at `http://localhost:8000/api`

### Alternative: Quick Setup (One Command)
```bash
composer run-script setup
```

This will automatically run all setup steps including migrations and npm build.

### Development Mode
To run the development server with live reload:
```bash
npm run dev
```

In another terminal:
```bash
php artisan serve
```

Or use the combined development script:
```bash
composer run dev
```

---

## 📝 Configuration Notes

### Database Setup
- Create a new MySQL database named `authorization_api`
- Update `.env` with your database credentials
- Run migrations: `php artisan migrate`

### Laravel Sanctum Configuration
Sanctum is already configured in `config/sanctum.php`
- Token expiration: 7 days (configurable)
- API rate limiting is enabled

### Spatie Permissions Configuration
Role and Permission tables are automatically created via migrations:
- `roles` - Stores user roles
- `permissions` - Stores available permissions
- `model_has_roles` - Maps roles to users
- `model_has_permissions` - Maps permissions to users
- `role_has_permissions` - Maps permissions to roles

---

## ▶️ Running the Application

### Production Server
```bash
php artisan serve --host=0.0.0.0 --port=8000
```

### Testing
```bash
php artisan test
```

### Accessing the API
Base URL: `http://localhost:8000/api`

Example request:
```bash
curl -X POST http://localhost:8000/api/login \
  -H "Content-Type: application/json" \
  -d '{"email":"user@example.com","password":"password"}'
```

---

## 📧 Troubleshooting

| Issue | Solution |
|-------|----------|
| Database connection error | Check `.env` credentials and ensure MySQL is running |
| Port 8000 already in use | Use `php artisan serve --port=8001` |
| Permission denied errors | Run `chmod -R 775 storage bootstrap/cache` |
| npm install fails | Delete `package-lock.json` and try again |
| Composer timeout | Run `composer config process-timeout 2000` |

---