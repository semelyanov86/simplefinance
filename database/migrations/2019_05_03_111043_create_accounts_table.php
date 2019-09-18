<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     * http://www.bik-info.ru/base.html
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('account_type');
            $table->enum('acc_state', [0,1,2])->default(0);
            $table->string('name');
            $table->text('description')->nullable();
            $table->float('start_balance');
            $table->string('currency_code')->nullable();
            $table->string('bank_bik')->nullable();
            $table->float('market_amount');
            $table->bigInteger('user_id')->unsigned();
            $table->softDeletes();
            $table->timestamps();

        });

        Schema::table('accounts', function($table) {
            $table->foreign('currency_code')->references('code')->on('currencies')->onDelete('cascade');
            $table->foreign('bank_bik')->references('bik')->on('banks')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounts');
    }
}
