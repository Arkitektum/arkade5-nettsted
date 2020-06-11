<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArkadeDownloadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arkade_downloads', function (Blueprint $table) {
            $table->id();
            $table->timestamp('downloaded_at')->useCurrent();

            $table->foreignId('arkade_release_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('organization_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('arkade_downloads');
    }
}
