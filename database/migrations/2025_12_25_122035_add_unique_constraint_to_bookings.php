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
    DB::statement("
        CREATE UNIQUE INDEX bookings_venue_id_booking_date_unique
        ON bookings (venue_id, booking_date)
    ");
}

public function down(): void
{
    DB::statement("
        DROP INDEX bookings_venue_id_booking_date_unique
        ON bookings
    ");
}
};
