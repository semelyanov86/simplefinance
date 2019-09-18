<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('category_name');
            $table->bigInteger('sys_category_id')->unsigned()->nullable();
            $table->enum('category_type', [1, -1])->default(1);
            $table->enum('isHidden', [0, 1])->default(0);
            $table->timestamps();

        });
        Schema::table('categories', function($table) {
            $table->foreign('sys_category_id')->references('id')->on('syscategories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
