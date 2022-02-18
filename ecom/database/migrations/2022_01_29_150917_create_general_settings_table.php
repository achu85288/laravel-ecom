<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_settings', function (Blueprint $table) {
            $table->id();
            $table->string('system_url');
            $table->string('system_title');
            $table->text('short_desc');
            $table->string('contact_email');
            $table->string('contact_mobile');
            $table->string('address');
            $table->string('header_logo');
            $table->string('footer_logo');
            $table->string('favicon');
            $table->string('admin_color');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('general_settings');
    }
}
