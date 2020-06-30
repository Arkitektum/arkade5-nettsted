<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArkadeDownloadersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
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
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('arkade_downloaders');
    }
}
