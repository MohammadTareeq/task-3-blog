# 🚀 Task 3 – Blog Application (Internship Project)

This is **Task 3** of my Web Development Internship at **ApexPlanet Software Pvt. Ltd.**  
It extends the **Task 2 Blog Application** by adding **search functionality, pagination, and a modern UI**.  

---

## ✨ Features
- 🔐 **User Authentication** → Register, login, logout (with secure password hashing)  
- 📑 **CRUD Operations** → Create, edit, delete, and manage blog posts  
- 🔎 **Search Posts** → Find posts by title or content  
- 📑 **Pagination** → Display posts 5 per page with Next/Previous navigation  
- 🎨 **Improved UI** → Dark theme with Bootstrap 5 + custom CSS  
- ⚡ **Secure & Lightweight** → Built using PHP + MySQL  

---

## 📂 Project Structure
-  blog_task3_app/
-  ├── README.md
-  ├── db.sql # Database schema
-  ├── includes/ # Config, auth, header, footer
-  ├── public/ # Main pages (index, register, login, CRUD)
-  └── assets/css/ # Custom styles

## ⚙️ Setup Instructions

### 1️⃣ Clone or Download
```bash
git clone https://github.com/your-username/blog_task3_app.git
Place the project inside your web root:
XAMPP (Windows) → C:\xampp\htdocs\blog_task3_app
WAMP (Windows) → C:\wamp64\www\blog_task3_app
MAMP (macOS) → /Applications/MAMP/htdocs/blog_task3_app

2️⃣ Database Setup
Open phpMyAdmin
Run the SQL in db.sql (creates blog DB with users and posts)
(Optional) Insert test user → Username: testuser, Password: 123456

3️⃣ Configure Database Connection
Open includes/config.php
Update your MySQL credentials:
DB_HOST
DB_NAME
DB_USER
DB_PASS

4️⃣ Run the Application
Start Apache & MySQL in XAMPP/WAMP/MAMP
Open in your browser:
http://localhost/blog_task3_app/public/

💻 Tech Stack
PHP
MySQL
Bootstrap 5
CSS

