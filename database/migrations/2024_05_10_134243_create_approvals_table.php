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
        Schema::create('approvals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('approver_id');
            $table->foreign('approver_id')->references('id')->on('users')->constrainted()->onDelete('cascade');
            $table->unsignedBigInteger('pengajuan_id');
            $table->foreign('pengajuan_id')->references('id')->on('pengajuans')->constrainted()->onDelete('cascade');
            $table->string('approver_role');
            $table->enum('approval_status', ['approved', 'rejected']);
            $table->datetime('approval_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('approvals');
    }
};
