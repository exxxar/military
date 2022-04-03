<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->bigInteger("current_people_index_all")->nullable(); //all
            $table->bigInteger("current_people_index_type_0")->nullable(); //в ненайденных
            $table->bigInteger("current_people_index_type_1")->nullable(); //в найденных
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
            $table->dropColumn("current_people_index_all");
            $table->dropColumn("current_people_index_type_0");
            $table->dropColumn("current_people_index_type_1");
        });
    }
};
