
# PHP & MySQL Blog — Task 2 (CRUD + Authentication)

This is a minimal, clean PHP project implementing **Task 2** from the internship PDF:
- CRUD for posts (Create, Read, Update, Delete)
- Basic authentication (Register, Login, Logout) using `password_hash` and sessions
- MySQL database `blog` with `users` and `posts` tables
- Secure prepared statements via PDO

## Folder structure
```
blog_task2_app/
├── README.md
├── db.sql
├── includes/
│   ├── config.php
│   ├── auth.php
│   ├── header.php
│   └── footer.php
├── public/
│   ├── index.php
│   ├── register.php
│   ├── login.php
│   ├── logout.php
│   ├── create_post.php
│   ├── edit_post.php
│   └── delete_post.php
└── assets/
    └── css/
        └── styles.css
```

## Quick Start (XAMPP/WAMP/MAMP)

1. **Clone/Copy** `blog_task2_app` into your web root:
   - XAMPP (Windows): `C:\xampp\htdocs\blog_task2_app`
   - WAMP: `C:\wamp64\www\blog_task2_app`
   - MAMP (macOS): `/Applications/MAMP/htdocs/blog_task2_app`

2. **Create the database**:
   - Open phpMyAdmin → SQL → paste `db.sql` → Run.

3. **Configure DB credentials**:
   - Edit `includes/config.php` and set `DB_HOST`, `DB_NAME`, `DB_USER`, `DB_PASS` according to your MySQL setup.

4. **Run the app**:
   - Visit: `http://localhost/blog_task2_app/public/`

## Notes
- Default uses PDO with exceptions + prepared statements.
- The `posts.user_id` links posts to the author; deleting a user sets `user_id` to NULL.
- This project intentionally keeps UI simple; you can add Bootstrap later.
