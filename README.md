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

## Database Structure

**Main Tables:**

- `users`: id, name, email, password, role, ...
- `nextspaces`: id, title, address, description, base_price, ...
- `bookings`: id, booking_id, user_id, nextspace_id, booked_for, booked_time_slot, status, checked_in_at, ...
- `amenities`: id, name, ...
- `services`: id, name, ...
- `favorites`: id, user_id, nextspace_id, ...
- `reviews`: id, user_id, nextspace_id, comment, rating, ...
- (Add other tables as needed)

---

## Folder Structure

```
/app
    /Http
        /Controllers
            /Admin
            /Auth
        /Models
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

## License

This project is for academic purposes only.
