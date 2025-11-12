<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasColumn('rasrama', 'siswa_id')) {
            $database = DB::getDatabaseName();

            // Try to find an existing foreign key constraint for siswa_id
            $constraint = DB::table('information_schema.KEY_COLUMN_USAGE')
                ->select('CONSTRAINT_NAME')
                ->where('TABLE_SCHEMA', $database)
                ->where('TABLE_NAME', 'rasrama')
                ->where('COLUMN_NAME', 'siswa_id')
                ->whereNotNull('REFERENCED_TABLE_NAME')
                ->value('CONSTRAINT_NAME');

            if ($constraint) {
                DB::statement("ALTER TABLE `rasrama` DROP FOREIGN KEY `$constraint`");
            }

            // Make the column nullable using raw SQL to avoid requiring doctrine/dbal
            DB::statement('ALTER TABLE `rasrama` MODIFY `siswa_id` BIGINT UNSIGNED NULL');

            // Recreate the foreign key if it existed before
            if ($constraint) {
                DB::statement("ALTER TABLE `rasrama` ADD CONSTRAINT `$constraint` FOREIGN KEY (`siswa_id`) REFERENCES `siswa`(`id`) ON DELETE CASCADE");
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('rasrama', 'siswa_id')) {
            $database = DB::getDatabaseName();
            $constraint = DB::table('information_schema.KEY_COLUMN_USAGE')
                ->select('CONSTRAINT_NAME')
                ->where('TABLE_SCHEMA', $database)
                ->where('TABLE_NAME', 'rasrama')
                ->where('COLUMN_NAME', 'siswa_id')
                ->whereNotNull('REFERENCED_TABLE_NAME')
                ->value('CONSTRAINT_NAME');

            if ($constraint) {
                DB::statement("ALTER TABLE `rasrama` DROP FOREIGN KEY `$constraint`");
            }

            // Change back to NOT NULL (this may fail if null values exist)
            DB::statement('ALTER TABLE `rasrama` MODIFY `siswa_id` BIGINT UNSIGNED NOT NULL');

            if ($constraint) {
                DB::statement("ALTER TABLE `rasrama` ADD CONSTRAINT `$constraint` FOREIGN KEY (`siswa_id`) REFERENCES `siswa`(`id`) ON DELETE CASCADE");
            }
        }
    }
};
