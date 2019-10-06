<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNotifySmsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('notify_frequency_sms')->default(0);
            $table->integer('notify_hours_sms')->default(0);
            $table->integer('notify_minutes_sms')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('notify_frequency_sms');
            $table->dropColumn('notify_hours_sms');
            $table->dropColumn('notify_minutes_sms');
        });
    }
}
