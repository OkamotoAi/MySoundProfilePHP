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
        Schema::create('music', function (Blueprint $table) {
            $table->string('music_id')->primary();
            $table->string('name');
            $table->string('artist');
            $table->integer('popularity')->nullable();
            $table->float('danceability')->nullable();
            $table->float('energy')->nullable();
            $table->integer('scale')->nullable();
            $table->float('loudness')->nullable();
            $table->integer('mode')->nullable();
            $table->float('speechiness')->nullable();
            $table->float('acousticness')->nullable();
            $table->float('instrumentalness')->nullable();
            $table->float('liveness')->nullable();
            $table->float('valence')->nullable();
            $table->float('tempo')->nullable();
            $table->integer('time_signature')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('music');
    }
};
