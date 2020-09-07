<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRequestHostToDownloadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('arkade_downloads', function (Blueprint $table) {
            $table->string('request_host', 64)->nullable()->after('downloaded_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('arkade_downloads', function (Blueprint $table) {
            $table->dropColumn('request_host');
        });
    }
}
