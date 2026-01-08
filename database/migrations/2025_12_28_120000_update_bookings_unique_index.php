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
        Schema::table('bookings', function (Blueprint $table) {
            // Drop the old unique index that prevents multiple sessions on the same date
            if (Schema::hasColumn('bookings', 'booksession')) {
                // Try to drop by columns; Laravel will resolve the index name
                $table->dropUnique(['venue_id', 'booking_date']);

                // Add a new unique constraint that includes booksession
                $table->unique(['venue_id', 'booking_date', 'booksession'], 'bookings_venue_date_session_unique');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Drop the 3-column unique and restore the original 2-column unique
            $table->dropUnique('bookings_venue_date_session_unique');
            $table->unique(['venue_id', 'booking_date']);
        });
    }
};
