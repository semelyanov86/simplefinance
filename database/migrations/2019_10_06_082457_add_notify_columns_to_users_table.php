<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNotifyColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('timezone')->default('Europe/Moscow');
            $table->string('phone', '20')->nullable();
            $table->string('notify_way', '10')->nullable();
            $table->integer('notify_frequency')->default(0);
            $table->integer('notify_hours')->default(0);
            $table->integer('notify_minutes')->default(0);
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
            $table->dropColumn('timezone');
            $table->dropColumn('phone');
            $table->dropColumn('notify_way');
            $table->dropColumn('notify_frequency');
            $table->dropColumn('notify_hours');
            $table->dropColumn('notify_minutes');
        });
    }
}
