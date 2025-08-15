<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsInTalentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('talents', function (Blueprint $table) {
            $table->date('birth_date')->nullable()->after('cv');
            $table->enum('gender', ['Pria', 'Wanita'])->after('birth_date')->nullable();
            $table->text('address')->after('gender')->nullable();
            $table->string('email')->after('address')->nullable();
            $table->string('phone')->after('email')->nullable();
            $table->text('tiktok')->after('instagram')->nullable();
            $table->string('password')->after('tiktok');
            $table->string('is_active')->default(0)->after('password');
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
            $table->dropColumn(['birth_date', 'gender', 'address', 'email', 'phone', 'tiktok', 'password']);
        });
    }
}
