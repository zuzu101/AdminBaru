<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAppearanceInTalentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('talents', function (Blueprint $table) {
            $table->string('birth_place')->after('birth_date')->default('-');
            $table->enum('appereance', ['Cakep Banget', 'Cakep', 'B Saja', 'Low End'])->after('gender')->default('Cakep Banget');
            $table->string('facebook')->after('tiktok')->nullable();
            $table->enum('marriage_status', ['Belum Menikah', 'Menikah', 'Lainnya'])->after('tiktok')->default('Belum Menikah');
            $table->text('introduction_link')->after('status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('talents', function (Blueprint $table) {
            $table->dropColumn(['birt_place', 'appereance', 'facebook', 'marriage_status', 'introduction_link']);
        });
    }
}
