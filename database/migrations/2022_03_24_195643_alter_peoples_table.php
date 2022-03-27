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
        //

        Schema::table("people", function (Blueprint $table){

            $table->string("phoenix_num")->nullable();
            $table->string("email")->nullable();
            $table->longText("passport")->nullable();
            $table->string("evacuation_place")->nullable();
            $table->integer("type")->default(0);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //

        Schema::table("people", function (Blueprint $table){

            $table->dropColumn("phoenix_num");
            $table->dropColumn("email");
            $table->dropColumn("type");
            $table->dropColumn("evacuation_place");

        });
    }
};
