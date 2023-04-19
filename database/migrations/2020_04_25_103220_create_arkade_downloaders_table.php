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
        Schema::create('arkade_downloaders', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->boolean('has_arkade_v1_experience')->default(false);;
            $table->boolean('wants_news')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arkade_downloaders');
    }
};
