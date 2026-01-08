<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // Drop old unique index if it exists, then add new unique index including status
        $connection = config('database.default');
        $database = DB::connection($connection)->getDatabaseName();

        $indexNameOld = 'bookings_venue_date_session_unique';
        $indexNameNew = 'bookings_venue_date_session_status_unique';

        $count = DB::select("SELECT COUNT(1) as c FROM information_schema.statistics WHERE table_schema = ? AND table_name = 'bookings' AND index_name = ?", [$database, $indexNameOld]);

        if (!empty($count) && isset($count[0]->c) && $count[0]->c > 0) {
            DB::statement("ALTER TABLE `bookings` DROP INDEX {$indexNameOld}");
        }

        Schema::table('bookings', function (Blueprint $table) use ($indexNameNew) {
            // create new unique index including status
            $table->unique(['venue_id', 'booking_date', 'booksession', 'status'], $indexNameNew);
        });
    }

    public function down()
    {
        $connection = config('database.default');
        $database = DB::connection($connection)->getDatabaseName();

        $indexNameOld = 'bookings_venue_date_session_unique';
        $indexNameNew = 'bookings_venue_date_session_status_unique';

        $count = DB::select("SELECT COUNT(1) as c FROM information_schema.statistics WHERE table_schema = ? AND table_name = 'bookings' AND index_name = ?", [$database, $indexNameNew]);

        if (!empty($count) && isset($count[0]->c) && $count[0]->c > 0) {
            DB::statement("ALTER TABLE `bookings` DROP INDEX {$indexNameNew}");
        }

        Schema::table('bookings', function (Blueprint $table) use ($indexNameOld) {
            $table->unique(['venue_id', 'booking_date', 'booksession'], $indexNameOld);
        });
    }
};
