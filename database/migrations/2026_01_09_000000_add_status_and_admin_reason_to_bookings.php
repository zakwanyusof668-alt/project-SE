<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            if (! Schema::hasColumn('bookings', 'status')) {
                $table->string('status')->default('booked')->after('purpose');
            }
            if (! Schema::hasColumn('bookings', 'admin_reason')) {
                $table->text('admin_reason')->nullable()->after('status');
            }
            if (! Schema::hasColumn('bookings', 'cancelled_by')) {
                $table->unsignedBigInteger('cancelled_by')->nullable()->after('admin_reason');
            }
        });
    }

    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            if (Schema::hasColumn('bookings', 'cancelled_by')) {
                $table->dropColumn('cancelled_by');
            }
            if (Schema::hasColumn('bookings', 'admin_reason')) {
                $table->dropColumn('admin_reason');
            }
            if (Schema::hasColumn('bookings', 'status')) {
                $table->dropColumn('status');
            }
        });
    }
};
