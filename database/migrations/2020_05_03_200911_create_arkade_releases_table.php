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
        Schema::create('arkade_releases', function (Blueprint $table) {
            $table->id();
            $table->string('version_number', 16);
            $table->string('user_interface', 3);
            $table->string('package_filename', 32)->nullable();
            $table->timestamp('released_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arkade_releases');
    }
};
