<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusPengirimanToPkgsTable extends Migration
{
    public function up()
    {
        Schema::table('pkgs', function (Blueprint $table) {
            if (!Schema::hasColumn('pkgs', 'status_pengiriman')) {
                $table->string('status_pengiriman')->nullable()->after('predikat_keterangan');
            }
        });
    }

    public function down()
    {
        Schema::table('pkgs', function (Blueprint $table) {
            if (Schema::hasColumn('pkgs', 'status_pengiriman')) {
                $table->dropColumn('status_pengiriman');
            }
        });
    }
}
