# Payroll Management System

## Project Title

Payroll Management System

## Description

This project is a web-based Payroll Management System developed using Laravel. The system is designed to help organizations manage departments, employees, and payroll processing efficiently. Users can create and manage departments, assign employees to departments, calculate monthly payroll based on salary, allowance, and overtime, and view payroll history with filtering and pagination features. The system also includes authentication and a modern UI design using Tailwind CSS.

---

## Getting Started

### Dependencies

Before running this project, ensure you have the following installed:

* PHP 8.2 or above (Recommended: PHP 8.4)
* Composer
* Node.js & npm
* Laravel CLI
* SQLite / MySQL
* Web Browser (Chrome recommended)

Example:

* macOS / Windows 10+

---

### Installing

1. Clone the repository:

```bash
git clone https://github.com/ammrmimi01-beep/payroll_management_system.git
cd payroll-system
```

2. Install dependencies:

```bash
composer install
npm install
npm run build
```

3. Setup environment file:

```bash
cp .env.example .env
php artisan key:generate
```

4. Setup database (SQLite):

```bash
touch database/database.sqlite
```

Update `.env`:

```env
DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite
```

5. Run migrations:

```bash
php artisan migrate
```

---

### Executing Program

Follow these steps to run the system locally:

1. Start the Laravel backend server:

```
php artisan serve
```

2. In a separate terminal, start the frontend (Vite):

```
npm run dev
```

3. Open your browser and access:

```
http://127.0.0.1:8000
```

⚠️ Note:

* Both commands must run simultaneously.
* If `npm run dev` is not running, the UI styling (Tailwind CSS) will not display correctly.


---

## Help

### Common Issues

**1. Database error**

* Ensure `.env` database path is correct
* Run:

```bash
php artisan migrate:fresh
```

**2. Changes not updating**

```bash
php artisan config:clear
php artisan cache:clear
```

**3. Styling not loading**

```bash
npm run build
```

---

## Authors

* Ammar Hamimi
  GitHub: https://github.com/ammrmimi01-beep/payroll_management_system.git

---

## Version History

1.0 – Final Release
* Implemented full CRUD for Departments and Employees
* Developed Payroll Processing feature
* Added filtering (by department, month, year)
* Implemented pagination for employee and payroll history
* Applied modern glassmorphism UI design
* Added validation & error handling (including delete restrictions)
* Improved user experience with confirmation prompts and auto-dismiss messages

---

## License

This project is for academic / assessment purposes.

---

## Acknowledgments

* Laravel Framework
* Tailwind CSS
* Laravel Breeze (Authentication)
* Inspiration from modern dashboard UI design
