<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOperationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date');
            $table->bigInteger('account_from_id')->unsigned();
            $table->bigInteger('account_to_id')->unsigned()->nullable();
            $table->string('type')->default('outcome');
            $table->decimal('amount_default_currency');
            $table->string('default_currency_code');
            $table->decimal('amount_from');
            $table->string('currency_from');
            $table->decimal('currency_course')->nullable();
            $table->decimal('amount_to_transfer')->nullable();
            $table->string('currency_to_transfer')->nullable();
            $table->text('comment');
            $table->bigInteger('category_id')->unsigned();
            $table->bigInteger('sys_category_id')->unsigned()->nullable();
            $table->bigInteger('user_id')->unsigned();
            $table->softDeletes();
            $table->timestamps();

        });
        Schema::table('operations', function($table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('sys_category_id')->references('id')->on('syscategories')->onDelete('cascade');
            $table->foreign('account_from_id')->references('id')->on('accounts')->onDelete('cascade');
            $table->foreign('currency_from')->references('code')->on('currencies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('operations');
    }
}
