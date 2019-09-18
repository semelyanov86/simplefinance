<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('timezone');
            $table->string('phone');
            $table->enum('by_sms', [0,1])->default(0);
            $table->tinyInteger('sms_remind_when')->default(0);
            $table->tinyInteger('sms_remind_hour')->nullable();
            $table->tinyInteger('sms_remind_minute')->nullable();
            $table->enum('by_email', [0,1])->default(0);
            $table->tinyInteger('email_remind_when')->default(0);
            $table->tinyInteger('email_remind_hour')->nullable();
            $table->tinyInteger('email_remind_minute')->nullable();
            $table->enum('google_sync', [0,1])->default(0);
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
        Schema::dropIfExists('notifications');
    }
}
