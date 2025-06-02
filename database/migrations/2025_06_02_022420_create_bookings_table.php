<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Links to the logged-in user
            $table->unsignedBigInteger('nextspace_id'); // Stores the ID from your mock data
            $table->string('booking_id')->unique(); // The unique ID for QR code scanning
            $table->string('nextspace_title');
            $table->string('nextspace_address');
            $table->string('nextspace_image_url')->nullable(); // URL for the image
            $table->string('booked_time_slot');
            $table->date('booking_date');
            $table->decimal('price', 8, 2); // Price for the booking
            $table->string('status')->default('confirmed'); // e.g., 'confirmed', 'pending', 'cancelled'
            $table->timestamps(); // created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};