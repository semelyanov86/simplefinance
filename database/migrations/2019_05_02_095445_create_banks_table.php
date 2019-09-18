<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('bik')->unique();
            $table->string('cs');
            $table->string('name');
            $table->string('namemini');
            $table->string('index');
            $table->string('city');
            $table->string('address');
            $table->string('phone');
            $table->string('okato');
            $table->string('okpo');
            $table->string('regnum');
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
        Schema::dropIfExists('banks');
    }
}
