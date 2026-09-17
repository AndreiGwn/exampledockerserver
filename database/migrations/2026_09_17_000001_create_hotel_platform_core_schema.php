<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Run createscript.sql for core table creation if exists
        $createScriptPath = file_exists(base_path('createscript.sql'))
            ? base_path('createscript.sql')
            : database_path('createscript.sql');

        if (file_exists($createScriptPath)) {
            $sql = file_get_contents($createScriptPath);
            DB::unprepared($sql);
        }

        // 2. Ensure reservations table exists
        if (! Schema::hasTable('reservations')) {
            Schema::create('reservations', function (Blueprint $table) {
                $table->id();
                $table->string('reservation_code', 32)->unique();
                $table->foreignId('hotel_id')->constrained('hotels')->cascadeOnDelete();
                $table->foreignId('room_id')->nullable()->constrained('rooms')->nullOnDelete();
                $table->string('guest_name');
                $table->string('guest_email')->index();
                $table->string('guest_phone');
                $table->string('guest_address')->nullable();
                $table->date('check_in')->nullable();
                $table->date('check_out')->nullable();
                $table->unsignedInteger('guests_count')->default(2);
                $table->text('special_requests')->nullable();
                $table->string('session_id', 100)->nullable()->index();
                $table->string('status', 50)->default('Confirmed');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
        Schema::dropIfExists('hotel_amenities');
        Schema::dropIfExists('amenities');
        Schema::dropIfExists('rooms');
        Schema::dropIfExists('hotels');
    }
};
