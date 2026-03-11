# 🚀 Laravel API Projects - Complete Series
## Activities 1, 2, 3, 4, 5, 6 & 7: From CRUD to Advanced Authorization, Notifications, Eloquent ORM & File Management

<div align="center">

![Laravel](https://img.shields.io/badge/Laravel-12.0-FF2D20?style=for-the-badge&logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php)
![MySQL](https://img.shields.io/badge/MySQL-8.0+-00758F?style=for-the-badge&logo=mysql)
![License](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)
![Status](https://img.shields.io/badge/Status-Active-success?style=for-the-badge)

A comprehensive learning project series demonstrating progressive API development from basic CRUD operations to advanced authentication and authorization systems using Laravel.

[📚 Activities](#-project-activities-overview) • [🛠️ Tech Stack](#-technologies-used) • [⚙️ Setup](#-installation--setup) • [🚀 Running](#-running-the-application) • [📝 API Docs](#-api-endpoints)

</div>

---

## 📑 Table of Contents

- [Project Overview](#-project-overview)
- [Project Activities Overview](#-project-activities-overview)
  - [Activity 2: Student CRUD API (Legacy)](#-activity-2-student-crud-api-legacy)
  - [Activity 3: Laravel Sanctum Authentication API](#-activity-3-laravel-sanctum-authentication-api)
  - [Activity 4: Authorization with Spatie Permissions](#-activity-4-authorization-with-spatie-laravel-permissions)
  - [Activity 5: Laravel Notifications System](#-activity-5-laravel-notifications-system)
  - [Activity 6: Laravel Eloquent ORM](#-activity-6-laravel-eloquent-orm)
  - [Activity 7: Laravel File Management](#-activity-7-laravel-file-management)
- [Technologies Used](#-technologies-used)
- [Installation & Setup](#-installation--setup)
- [Running the Application](#-running-the-application)
- [API Endpoints](#-api-endpoints)
- [Configuration Notes](#-configuration-notes)
- [Troubleshooting](#-troubleshooting)

---

## 📌 Project Overview

This repository contains a comprehensive educational series of Laravel API projects designed to teach progressive API development skills. Starting from basic CRUD operations to implementing enterprise-level authentication and authorization systems, each activity builds upon previous knowledge.

**Learning Progression:**
- **Activity 1**: Foundations (not included in this repo)
- **Activity 2**: Basic CRUD operations with MySQL
- **Activity 3**: Secure token-based authentication with Laravel Sanctum
- **Activity 4**: Role-based access control with Spatie permissions
- **Activity 5**: Database and mail notification system with real-time alerts
- **Activity 6**: Demonstrate Laravel Eloquent ORM basics including models, migrations, blade views and simple CRUD operations
- **Activity 7**: Add file management features (upload, list, download, delete) with database tracking

---

## 📋 Project Activities Overview

### ✅ ACTIVITY 2: Student CRUD API (Legacy)
A legacy REST API for managing student records with basic CRUD operations.

**🎯 Functions & Description:**
- Create new student records
- Read/Retrieve student data
- Update existing student information
- Delete student records
- Basic validation and data persistence
- MySQL database integration

---

### ✅ ACTIVITY 3: Laravel Sanctum Authentication API

A fully functional Authentication API built with Laravel Sanctum featuring token-based authentication with secure user management.

**🎯 Functions & Description:**
- **User Registration** - Register new users with validation (email, password)
- **User Login** - Authenticate users and generate secure Bearer tokens
- **Protected Routes** - Secure API endpoints using token-based authentication
- **Get Authenticated User Data** - Retrieve current user information
- **Single Device Logout** - Invalidate current session token
- **Multi-Device Logout** - Invalidate all session tokens for a user
- **Token Expiration** - Automatic token expiration after 7 days
- **MySQL Database Persistence** - Secure user data storage

---

## 📝 API Endpoints

### Activity 3 - Authentication Endpoints

| Method | Endpoint | Description | Auth Required |
|--------|----------|-------------|---------------|
| POST | `/api/register` | Register new user with validation | No |
| POST | `/api/login` | Login & get authentication token | No |
| GET | `/api/test` | Test API connectivity | No |
| GET | `/api/user` | Get authenticated user data | Yes |
| POST | `/api/logout` | Logout from current device | Yes |
| POST | `/api/logout-all` | Logout from all devices | Yes |

### Activity 5 - Notification Endpoints

| Method | Endpoint | Description | Auth Required |
|--------|----------|-------------|---------------|
| GET | `/send-notification` | Send test notification to authenticated user via mail & database | Yes |
| GET | `/notifications` | View all notifications for authenticated user | Yes |
| GET | `/unread-notifications` | View only unread notifications for authenticated user | Yes |
| POST | `/notifications/read` | Mark all notifications as read for authenticated user | Yes |

### Activity 6 - Eloquent Student Endpoints

| Method | Endpoint | Description | Auth Required |
|--------|----------|-------------|---------------|
| GET | `/add-student` | Insert a sample student record (web route) | No |
| GET | `/students` | Return all student records as JSON | No |
| GET | `/students-view` | Display all students in a Blade view | No |
| GET | `/update-student` | Modify the course field for student ID 1 | No |
| GET | `/delete-student` | Delete student record ID 1 | No |

### Activity 7 - File Management Endpoints

| Method | Endpoint | Description | Auth Required |
|--------|----------|-------------|---------------|
| GET  | `/upload`        | Show upload form view | No |
| POST | `/upload-file`   | Handle multiple file upload (jpg,png,pdf,docx) | No |
| GET  | `/files`         | Display list of uploaded files | No |
| GET  | `/download/{id}` | Download file by ID (increments count) | No |
| GET/DELETE | `/delete/{id}`  | Remove file record and storage file | No |

---

### ✅ Activity 4: Authorization with Spatie Laravel Permissions

Advanced role-based access control (RBAC) system using Spatie Laravel Permissions package for granular authorization management.

**🎯 Functions & Description:**
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

### ✅ Activity 5: Laravel Notifications System

A comprehensive notification system using Laravel's built-in notification features with support for database and mail channels.

**🎯 Functions & Description:**
- **Send Notifications** - Send notifications to users via mail and database channels
- **Database Storage** - Store notifications in the database for persistent access
- **Mail Notifications** - Send email notifications to users
- **View All Notifications** - Display all notifications for authenticated users
- **View Unread Notifications** - Filter and display only unread notifications
- **Mark as Read** - Mark individual or all notifications as read
- **Notification Metadata** - Store and retrieve notification data with custom information
- **Real-time Notification Interface** - Interactive UI for managing notifications
- **Notification Status Tracking** - Track read/unread status with timestamps
- **Type-based Notifications** - Support for different notification types

**Key Features:**
- Laravel notification system integration
- Database channel for persistent notification storage
- Mail channel for email delivery
- UUID-based notification tracking
- Read/unread notification filtering
- Blade template views for notification display
- Timestamp tracking for notification creation and reading
- Polymorphic notification system for multiple notifiable models

---

### ✅ Activity 6: Laravel Eloquent ORM

Introduction to the Eloquent Object-Relational Mapper. Demonstrates model definitions, migrations, simple relationships, and basic CRUD using routes and blade views.

**🎯 Functions & Description:**
- **Student Model & Migration** – Defines `Student` with fillable fields (name, email, course)
- **Create Records** – Route `/add-student` seeds a sample student using `Student::create()`
- **Read Records** – JSON endpoint `/students` and blade view `/students-view` show all students
- **Update Records** – Route `/update-student` finds by ID and updates a field
- **Delete Records** – Route `/delete-student` removes a student record
- **Blade Rendering** – Display students in a simple `students.blade.php` view using the `$students` variable
- **Eloquent Methods** – Usage of `all()`, `find()`, `save()`, `delete()` in closures

**Key Features:**
- Demonstrates Laravel's expressive query methods
- Shows basic use of `fillable` and mass assignment
- Introduces migrations for creating tables
- Provides web-based UI and API-style access

---

### ✅ ACTIVITY 7: Laravel File Management
A robust file handling system demonstrating file storage, database tracking, and dynamic UI for uploads.

**🎯 Functions & Description:**
- **Upload Multiple Files** – Users can select or drag‑and‑drop images, documents, PDFs
- **Validation** – Restrict types and size (jpg,png,pdf,docx ≤ 2 MB each)
- **Store in Public Disk** – Files saved under `storage/app/public/uploads`
- **Database Records** – `FileUpload` model tracks metadata (name, path, size, mime, downloads)
- **List Files** – `/files` blade view shows cards with previews, stats, and actions
- **Download & Count** – `/download/{id}` serves file and increments download count
- **Delete** – `/delete/{id}` removes both storage file and DB record
- **Interactive UI** – Fancy drag‑drop form and responsive cards

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

## 📚 Learning Resources

### Official Documentation
- [Laravel Documentation](https://laravel.com/docs)
- [Laravel Sanctum](https://laravel.com/docs/sanctum)
- [Spatie Laravel Permissions](https://spatie.be/docs/laravel-permission/v6/introduction)

### Video Tutorials
- Laravel API Development
- Token-Based Authentication
- Role-Based Access Control

---

## 🤝 Contributing

Contributions are welcome! To contribute:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit changes (`git commit -m 'Add amazing feature'`)
4. Push to branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

---

## 📄 License

This project is licensed under the **MIT License** - see the [LICENSE](LICENSE) file for details.

---

## 💬 Support & Questions

For questions or support:
- 📧 Email: [andasan.dejhay123@gmail.com]
- 💬 GitHub Issues: [Open an issue](https://github.com/Andasan01)
- 📝 Documentation 1, 2, 3, 4, 5, 6 and 7 

---

## 👨‍💻 Author

**Dejhay Andasan**
- 🎓 Course: Integrative Programming and Technologies
- 📅 Created: March 2026
- 🏆 Activities:1, 2, 3, 4, 5, 6 and 7 (Completed)

---

<div align="center">

**Made with ❤️ for learning Laravel API Development**

⭐ If this project helped you, please consider giving it a star!

[⬆ Back to top](#-laravel-api-projects---complete-series)

</div>