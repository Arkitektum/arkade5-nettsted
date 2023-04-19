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
        Schema::create('arkade_downloads', function (Blueprint $table) {
            $table->id();
            $table->timestamp('downloaded_at')->useCurrent();

            $table->foreignId('arkade_release_id')->constrained();
            $table->foreignId('arkade_downloader_id')->constrained();
            $table->foreignId('organization_id')->nullable()->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arkade_downloads');
    }
};
