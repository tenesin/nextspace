# NextSpace

This project is developed as the final project for the subject **PPPL**.

---

## Group Members

- Name 1 (NIM)
- Name 2 (NIM)
- Name 3 (NIM)
- Name 4 (NIM)
- (Add or remove as needed)

---

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

---

## Folder Structure

```
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
```

---

## Setup

1. **Clone the repository:**

    ```sh
    git clone <repo-url>
    cd nextspace
    ```

2. **Install dependencies:**

    ```sh
    composer install
    npm install
    ```

3. **Copy and edit environment file:**

    ```sh
    cp .env.example .env
    # Edit .env for your database and mail settings
    ```

4. **Generate application key:**

    ```sh
    php artisan key:generate
    ```

5. **Run migrations and seeders:**

    ```sh
    php artisan migrate --seed
    ```

6. **Build frontend assets:**

    ```sh
    npm run build
    ```

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

This project is for academic purposes only.
