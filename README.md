Here’s a **cleaned up and comprehensive** version of your markdown for the **NextSpace** project:

---

# 🧠 NextSpace

> Final project for the **PPPL** (Pemrograman Proyek Perangkat Lunak) course.

---

<<<<<<< HEAD
## 👥 Group Members

* Name 1 (NIM)
* Name 2 (NIM)
* Name 3 (NIM)
* Name 4 (NIM)
  \**(Add or remove as needed)*
=======
## Project Overview

NextSpace is a web-based platform for booking co-working spaces, developed using Laravel and modern web technologies.  
It supports user registration, space management, booking, check-in (including QR and manual admin check-in), reviews, favorites, and reporting.

---

## Database Structure

**Main Tables:**

- `users`: id, name, email, password, role, ...
- `nextspaces`: id, title, address, description, image, phone, rating, reviews_count, base_price, ...
- `bookings`: id, booking_id, user_id, nextspace_id, nextspace_title, nextspace_address, nextspace_image_url, booked_time_slot, booked_for, booking_date, price, status, checked_in_at, selected_services_details, ...
- `amenities`: id, name, ...
- `services`: id, name, price, ...
- `favorites`: id, user_id, nextspace_id, ...
- `reviews`: id, user_id, booking_id, nextspace_id, rating, comment, ...
- `nextspace_amenity`: nextspace_id, amenity_id (pivot)
- `nextspace_service`: nextspace_id, service_id (pivot)
- `nextspace_time_slot`: nextspace_id, time_slot_id, capacity (pivot)
- `time_slots`: id, slot, ...
- `nextspace_hours`: id, nextspace_id, day_type, open_time, close_time, ...
>>>>>>> 05e3a5ede1cdf293be2271a7d94995be32bf9ea3

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
<<<<<<< HEAD
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
=======
/app
    /Exports
        NextspacesExport.php
    /Http
        /Controllers
            /Admin
            /Auth
            Controller.php
            FavoriteController.php
            HistoryController.php
            NextspaceController.php
            PaymentController.php
            PenaltyController.php
            ProfileController.php
            QrCodeController.php
            ReviewController.php
        /Middleware
            IsAdmin.php
        /Requests
            ...
    /Models
        Amenity.php
        Booking.php
        Favorite.php
        Nextspace.php
        NextspaceHour.php
        Review.php
        Service.php
        TimeSlot.php
        User.php
    /Notifications
        BookingCheckedIn.php
    /Providers
        AppServiceProvider.php
    /View
        /Components
            AppLayout.php
            GuestLayout.php
/config
/database
    /migrations
    /seeders
/public
/resources
    /views
        /admin
        /nextspaces
        /favorites
        /history
        /components
        /layouts
/routes
    web.php
>>>>>>> 05e3a5ede1cdf293be2271a7d94995be32bf9ea3
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

<<<<<<< HEAD
### 7. Start Development Server

```bash
php artisan serve
```

---

## 📄 License
=======
7. **Start the development server:**

    ```sh
    php artisan serve
    ```

---

## Features

- User registration, login, and profile management
- Browse and search for available NextSpaces
- Book spaces with time slots and optional services
- Payment simulation (cash and non-cash)
- Admin dashboard for managing spaces, bookings, and reports
- Manual and QR-based check-in for admins
- User reviews and favorites
- Export business reports (Excel)
- Responsive design with Tailwind CSS

---

## Prettier Code Formatting

To format all files using Prettier:

```sh
npx prettier --write .
```

Your `.prettierrc` is already set up for Blade, JS, CSS, and more.

---

## License
>>>>>>> 05e3a5ede1cdf293be2271a7d94995be32bf9ea3

This project is created **for academic purposes only**.
All rights reserved by the authors.

---

If you'd like, I can also generate a `README.md` file with this content or help add badges, screenshots, or contribution guidelines.
