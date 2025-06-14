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
        Schema::create('janji_periksas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pasien')->constrained('users')->onDelete('cascade');
            $table->unsignedBigInteger('id_jadwal_periksa');
            $table->text('keluhan');
            $table->string('no_antrian', 10); // fixed typo
            $table->timestamps();

            $table->foreign('id_jadwal_periksa')
                ->references('id')->on('jadwal_periksas')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('janji_periksas');
    }
};
