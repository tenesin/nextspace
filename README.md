---

# 🧠 NextSpace

> Final project for the **PPPL** (Pemrograman Proyek Perangkat Lunak) course.

---

## 👥 Group Members

* Name 1 (NIM)
* Name 2 (NIM)
* Name 3 (NIM)
* Name 4 (NIM)
  \**(Add or remove as needed)*

---

## 🗄️ Database Structure

### 🔐 `users`

* `id`, `name`, `email`, `password`, `role`, ...

### 🏢 `nextspaces`

* `id`, `title`, `address`, `description`, `base_price`, ...

### 📅 `bookings`

* `id`, `booking_id`, `user_id`, `nextspace_id`, `booked_for`, `booked_time_slot`, `status`, `checked_in_at`, ...

### 🛠️ `amenities`

* `id`, `name`, ...

### 📦 `services`

* `id`, `name`, ...

### ⭐ `favorites`

* `id`, `user_id`, `nextspace_id`, ...

### 📝 `reviews`

* `id`, `user_id`, `nextspace_id`, `comment`, `rating`, ...

*You can extend this as your project evolves.*

---

## 📁 Project Folder Structure

```
nextspace/
├── app/
│   └── Http/
│       └── Controllers/
│           ├── Admin/
│           └── Auth/
│       └── Models/
├── config/
├── database/
│   ├── migrations/
│   └── seeders/
├── public/
├── resources/
│   └── views/
│       ├── admin/
│       ├── nextspaces/
│       ├── favorites/
│       ├── history/
│       ├── components/
│       └── layouts/
├── routes/
│   └── web.php
```

---

## ⚙️ Setup Instructions

### 1. Clone the Repository

```bash
git clone <repo-url>
cd nextspace
```

### 2. Install Backend & Frontend Dependencies

```bash
composer install
npm install
```

### 3. Configure Environment

```bash
cp .env.example .env
# Edit .env with your DB and mail config
```

### 4. Generate Application Key

```bash
php artisan key:generate
```

### 5. Run Migrations and Seeders

```bash
php artisan migrate --seed
```

### 6. Build Frontend Assets

```bash
npm run build
```

### 7. Start Development Server

```bash
php artisan serve
```

---

## 📄 License

This project is created **for academic purposes only**.
All rights reserved by the authors.

---
