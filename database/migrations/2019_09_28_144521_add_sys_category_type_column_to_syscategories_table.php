<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSysCategoryTypeColumnToSyscategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('syscategories', function (Blueprint $table) {
            $table->enum('sys_category_type', ['1', '-1']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('syscategories', function (Blueprint $table) {
            $table->dropColumn('sys_category_type');
        });
    }
}
