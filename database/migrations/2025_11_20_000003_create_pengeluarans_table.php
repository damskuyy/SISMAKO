<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pengeluarans', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_pengeluaran');
            $table->string('jenis');
            $table->string('nama');
            $table->bigInteger('nominal')->default(0);
            $table->text('keterangan')->nullable();
            $table->unsignedBigInteger('sarpras_id')->nullable();
            $table->string('sarpras_type')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pengeluarans');
    }
};
