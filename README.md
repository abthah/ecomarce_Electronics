# TechRental - Electronic Equipment Borrowing App

## Description
TechRental is a web application built with Laravel for managing the borrowing of electronic equipment. It provides features for user registration, login, equipment management, borrowing requests, and an admin dashboard to manage all data.

---

## Main Features
- **User Registration & Login**: Users can create an account and log in to access the app's features.
- **Equipment Management**: Admins can add, edit, and delete electronic equipment data.
- **Borrowing Requests**: Users can request to borrow equipment. The system will automatically reduce the equipment stock.
- **Return & Stock Management**: When a borrowing record is deleted, the equipment stock is automatically restored.
- **Dashboard**: Admin dashboard to view and manage equipment and borrowing data.
- **Notifications**: Success or error messages are shown based on user actions.

---

## How to Install & Run Locally

### 1. Clone the Repository
```bash
git clone <your-repo-url>
cd elektronik
```

### 2. Install Backend Dependencies (Laravel)
Make sure you have PHP >= 8.2 and Composer installed.
```bash
composer install
```

### 3. Install Frontend Dependencies
Make sure you have Node.js & npm installed.
```bash
npm install
```

### 4. Configure Environment
Copy the example environment file and set up your database configuration:
```bash
cp .env.example .env
```
Then generate the application key:
```bash
php artisan key:generate
```

### 5. Run Database Migrations
Create the necessary tables:
```bash
php artisan migrate
```

### 6. Run the Application
Start the Laravel server and Vite for frontend assets:
```bash
npm run dev
php artisan serve
```
Or use the composer script (if available):
```bash
composer run dev
```
Access the app at `http://localhost:8000`.

---

## How the App Works

1. **Landing Page**  
   Visitors see a list of available electronic equipment to borrow.
2. **Registration & Login**  
   Users must register and log in to request a borrowing.
3. **Borrowing Equipment**  
   Users select equipment, fill out the borrowing form (quantity, duration, personal info), and submit. The system checks stock and reduces it if the request is successful.
4. **Equipment Management (Admin)**  
   Admins can add, edit, and delete equipment via the dashboard. Admins can also view and manage borrowing data.
5. **Returning Equipment**  
   If a borrowing record is deleted, the equipment stock is automatically restored.
6. **Security**  
   All management features require the user to be logged in.

---

## Tech Stack
- **Backend**: Laravel 12.x
- **Frontend**: Blade, TailwindCSS, Vite, Alpine.js
- **Database**: MySQL (or as configured in `.env`)
- **Authentication**: Laravel Breeze

---

## Contribution
Feel free to open a pull request or issue if you want to contribute.
