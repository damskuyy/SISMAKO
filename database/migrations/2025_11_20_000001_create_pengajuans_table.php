<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pengajuans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('surat_id')->nullable();
            $table->unsignedBigInteger('guru_id')->nullable();
            $table->string('foto_lpj')->nullable();
            $table->date('tanggal_pengajuan');
            $table->string('deskripsi');
            $table->bigInteger('nominal')->default(0);
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pengajuans');
    }
};
