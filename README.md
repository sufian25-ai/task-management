# 📋 Task Management System (Laravel 11)

A modern, role-based task management web app built with **Laravel 11**, featuring **real-time AJAX updates**, **Tailwind UI**, and an **Admin Dashboard**.

---

## 🚀 Features

### 🗂️ Project Management
- CRUD (Create, Edit, Delete)
- Progress tracking & project stats

### ✅ Task Management
- CRUD tasks (title, status, due date)
- Filter by status/project/due date
- AJAX-based status updates

### 📊 Dashboard
- Total, Completed & Due-today stats
- Recent projects & upcoming tasks

### 🛡️ Role-Based Access
- Admin → Manage users, projects, tasks
- User → Manage own data only

### 🎨 UI / UX
- Gradient navbar (Indigo → Purple → Pink)
- Responsive design
- Smooth animations

---

## 🧠 Tech Stack
**Backend:** Laravel 11, PHP 8.2+, MySQL  
**Frontend:** Tailwind CSS, Alpine.js  
**Auth:** Laravel Breeze  
**Tools:** Vite, Eloquent ORM, Carbon

---

## 🧩 Installation
```bash
git clone https://github.com/sufian25-ai/task-management.git
cd task-management
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate:fresh --seed
npm run dev
php artisan serve
```
Visit → http://127.0.0.1:8000

---

## 🔑 Default Login
**Admin:** `admin@gmail.com` / `admin123`  
**User:** `msufianbd92@gmail.com` / `12345678`

---

## 🗄️ Database Design
```
User → hasMany → Project  
Project → hasMany → Task
```

| Table | Fields |
|--------|---------|
| users | id, name, email, role |
| projects | id, name, description, user_id |
| tasks | id, title, status, due_date, project_id |

---

## ⚙️ Admin Panel
- Manage Users & Roles  
- Delete any Project/Task  
- View system statistics

---

## 👨‍💻 Author
**Md Mahabub (Sufian)**  
GitHub: [@sufian25-ai](https://github.com/sufian25-ai)  
Email: msufianbd92@gmail.com

---

## 📝 License
MIT © 2025 | Built with ❤️ using Laravel
