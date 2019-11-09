<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExtraDebitCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extra_debit_cards', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('account_id')->unsigned()->nullable();
            $table->bigInteger('card_type_id')->unsigned()->nullable();
            $table->integer('expire_date_month')->nullable();
            $table->integer('expire_date_year')->nullable();
            $table->float('year_cost')->nullable();
            $table->float('rate_balance')->nullable();
            $table->float('atm_commission')->nullable();
            $table->float('other_atm_commission')->nullable();
            $table->timestamps();
        });
        Schema::table('extra_debit_cards', function ($table) {
            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade');
        });
        Schema::table('extra_debit_cards', function ($table) {
            $table->foreign('card_type_id')->references('id')->on('card_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('extra_debit_cards');
    }
}
