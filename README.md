# 🧠 NextSpace

> Final project for the **PPPL** (Pemrograman Proyek Perangkat Lunak) course.

---

## 👥 Group Members

* Viqi Alvianto (5026221001)
* Regina Dwi Aulia (5026221063)
* Luthfi Rihadatul Fajri (5026221077)
* Muhammad Fauzan (5026221080)
* Ashila Mahdiyyah (5026221148)
* Adithya Eka Pramudita (5026221164)
* Dinanti Vita Rachman (5026221190)
* Ratna Amalia Azzahra (5026221209)
* Muhammad Rafa Akbar (5026221213)
* Ishaq Yudha Alnafi Syahputra (5026221214)

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


