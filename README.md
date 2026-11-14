# ⚙️ Contentify CMS — RESTful API Backend

A robust, secure, and high-performance RESTful API built with **Laravel 11** and **MySQL**, architected using **Clean Code** principles, separation of concerns, and industry-standard security practices.

🌐 **Live Frontend App:** [https://vercel.app](https://vercel.app)  
💻 **Frontend Repository:** [Contentify-CMS-frontend](https://github.com)

---

## ✨ Architectural Highlights & Features

- **🔐 Token-Based Authentication:** Powered by **Laravel Sanctum** for stateless, secure API authentication.
- **📝 Complete Post Management (CRUD):** Structured endpoints for creating, retrieving, updating, and deleting posts with strict validation.
- **🧹 Clean Architecture & Best Practices:**
  - **Form Requests:** Dedicated validation classes keeping controllers thin and focused.
  - **API Resources:** Standardized, consistent JSON response transformations.
  - **Policies & Authorization:** Granular access control ensuring users can only modify or delete their own resources.
- **🗄️ Relational Database Design:** Optimized **MySQL** schema with clean migrations and Eloquent ORM relationships.
- **🌍 CORS & Production Ready:** Configured for seamless cross-origin communication with decoupled SPA frontends.

---

## 🛠️ Tech Stack

- **Framework:** Laravel 11 (PHP 8.4)
- **Database:** MySQL 8
- **Authentication:** Laravel Sanctum
- **Architecture:** RESTful API, MVC + Form Requests, Policies & API Resources
- **Deployment:** EthioDeploy Cloud

---

## 🔌 Core API Endpoints

| Method | Endpoint | Description | Auth Required |
| :--- | :--- | :--- | :---: |
| `POST` | `/api/register` | Register a new user account | ❌ |
| `POST` | `/api/login` | Authenticate user & issue token | ❌ |
| `GET` | `/api/posts` | Retrieve all posts | ✅ |
| `POST` | `/api/posts` | Create a new post | ✅ |
| `PUT` | `/api/posts/{id}` | Update an existing post | ✅ |
| `DELETE` | `/api/posts/{id}` | Delete a post | ✅ |

---

## 🚀 Getting Started Locally

1. **Clone the repository:**
   ```bash
   git clone https://github.com
   cd taskMangment-backend
   ```

2. **Install PHP dependencies:**
   ```bash
   composer install
   ```

3. **Environment setup:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   *(Configure your `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD` in `.env`)*

4. **Run migrations & start server:**
   ```bash
   php artisan migrate
   php artisan serve
   ```

---

## 👨‍💻 Author

**Ahmed Badwy**  
- GitHub: [@ahmedbadwy-dev](https://github.com)
