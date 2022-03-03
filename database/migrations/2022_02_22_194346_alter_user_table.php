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
        Schema::table("users",function (Blueprint $table){
            $table->string("telegram_chat_id",50)->unique();
            $table->string("phone",50)->nullable();
            $table->string("full_name",255)->nullable();
            $table->double("radius")->default(0.1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("users",function (Blueprint $table){
            $table->dropColumn("telegram_chat_id");
            $table->dropColumn("radius");
            $table->dropColumn("phone");
            $table->dropColumn("full_name");
        });
    }
};
