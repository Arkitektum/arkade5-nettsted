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
        Schema::table('arkade_releases', function (Blueprint $table) {
            $table->timestamp('dereleased_at')->nullable()->after('released_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('arkade_releases', function (Blueprint $table) {
            $table->dropColumn('dereleased_at');
        });
    }
};
