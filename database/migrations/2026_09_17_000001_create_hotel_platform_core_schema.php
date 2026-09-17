<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations by executing createscript.sql and Stored Procedures.
     */
    public function up(): void
    {
        // 1. Run createscript.sql for core table creation if not already present
        $createScriptPath = file_exists(base_path('createscript.sql')) 
            ? base_path('createscript.sql') 
            : database_path('createscript.sql');

        if (file_exists($createScriptPath)) {
            $sql = file_get_contents($createScriptPath);
            DB::unprepared($sql);
        }

        // Ensure users table has role, phone, and company_name columns
        if (Schema::hasTable('users')) {
            Schema::table('users', function ($table) {
                if (! Schema::hasColumn('users', 'role')) {
                    $table->string('role', 50)->default('eigenaar')->index();
                }
                if (! Schema::hasColumn('users', 'phone')) {
                    $table->string('phone', 50)->nullable();
                }
                if (! Schema::hasColumn('users', 'company_name')) {
                    $table->string('company_name', 255)->nullable();
                }
            });
        }

        // 2. Load and register all Stored Procedures from Stored Procedures directory
        $spDirectories = [base_path('Stored Procedures'), database_path('StoredProcedures'), database_path('Stored Procedures')];
        foreach ($spDirectories as $dir) {
            if (is_dir($dir)) {
                $files = glob($dir.'/*.sql');
                foreach ($files as $file) {
                    $spSql = file_get_contents($file);
                    $cleanedSql = preg_replace('/DELIMITER\s+\/\/|DELIMITER\s+;/i', '', $spSql);
                    try {
                        DB::unprepared($cleanedSql);
                    } catch (Throwable $e) {
                        // Stored procedure already created or warning
                    }
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
        Schema::dropIfExists('hotel_amenities');
        Schema::dropIfExists('amenities');
        Schema::dropIfExists('rooms');
        Schema::dropIfExists('hotels');
    }
};
