# Create a README for your project
cat > README.md << 'EOF'
# Laravel Sanctum Authentication API

A fully functional Authentication API built with Laravel Sanctum featuring token-based authentication.

## ✨ Features
- User Registration with validation
- User Login with token generation  
- Protected routes using Bearer tokens
- Get authenticated user data
- Logout (token invalidation)
- MySQL database persistence
- Token expiration (7 days)

## 🚀 API Endpoints

| Method | Endpoint | Description | Auth Required |
|--------|----------|-------------|---------------|
| POST | `/api/register` | Register new user | No |
| POST | `/api/login` | Login & get token | No |
| GET | `/api/test` | Test API | No |
| GET | `/api/user` | Get user data | Yes |
| POST | `/api/logout` | Logout | Yes |
| POST | `/api/logout-all` | Logout all devices | Yes |

## 🛠️ Installation

1. Clone the repository
```bash