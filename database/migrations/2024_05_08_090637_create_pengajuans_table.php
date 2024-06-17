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
        Schema::create('pengajuans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->constrainted()->onDelete('cascade');
            $table->string('nama');
            $table->string('no_hp');
            $table->string('no_ktp');
            $table->string('foto_ktp');
            $table->string('kartu_vaksin');
            $table->string('surat_kesehatan');
            $table->string('bebas_narkoba');
            $table->string('skck');
            $table->string('surat_keterangan_user');
            $table->enum('area',['kantor','pabrik']);
            $table->string('keperluan');    
            $table->string('keperluan_lainnya')->nullable();    
            $table->string('tujuan');
            $table->string('tujuan_lainnya')->nullable();
            $table->string('lama_kunjungan');
            $table->string('unit_kerja');
            $table->string('nama_perusahaan');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuans');
    }
};
