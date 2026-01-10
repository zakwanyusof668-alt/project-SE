<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Add a new unique index that includes booksession
        DB::statement("
            CREATE UNIQUE INDEX IF NOT EXISTS bookings_venue_date_session_unique
            ON bookings (venue_id, booking_date, booksession)
        ");
    }

    public function down(): void
    {
        // Drop the 3-column unique index safely
        DB::statement("
            DROP INDEX IF EXISTS bookings_venue_date_session_unique
            ON bookings
        ");
    }
};
