<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTargetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('targets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('target_type', [1, -1])->default(1);
            $table->bigInteger('target_category_id')->unsigned();
            $table->string('target_name');
            $table->string('target_currency_code');
            $table->bigInteger('account_from_id')->unsigned();
            $table->enum('target_status', [0, 1])->default(0);
            $table->float('target_amount_total');
            $table->date('first_pay_date')->nullable();
            $table->float('monthly_pay_amount');
            $table->date('pay_to_date');
            $table->text('comment')->nullable();
            $table->string('image')->nullable();
            $table->enum('target_is_done', [0,1])->default(0);
            $table->bigInteger('user_id')->unsigned();
            $table->timestamps();


        });
        Schema::table('targets', function($table) {
            $table->foreign('target_category_id')->references('id')->on('target_categories')->onDelete('cascade');
            $table->foreign('target_currency_code')->references('code')->on('currencies')->onDelete('cascade');
            $table->foreign('account_from_id')->references('id')->on('accounts')->onDelete('cascade');
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
        Schema::dropIfExists('targets');
    }
}
