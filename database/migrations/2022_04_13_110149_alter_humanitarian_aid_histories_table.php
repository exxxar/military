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

        Schema::table("humanitarian_aid_histories",function (Blueprint $table){
           $table->string("t_name")->nullable()->after("full_name");
           $table->string("f_name")->nullable()->after("t_name");
           $table->string("s_name")->nullable()->after("f_name");
           $table->boolean("has_children")->default(false);
           $table->date("passport_issue_at")->nullable()->after("passport");
           $table->integer("count")->default(1);
           $table->json("children")->nullable();
           $table->json("types")->nullable();
           //$table->dropColumn("index");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("humanitarian_aid_histories",function (Blueprint $table){
            $table->dropColumn("t_name");
            $table->dropColumn("f_name");
            $table->dropColumn("s_name");
            $table->dropColumn("has_children");
            $table->dropColumn("passport_issue_at");
            $table->dropColumn("count");
            $table->dropColumn("children");
            $table->dropColumn("types");
            //$table->string("index")->nullable();
        });
    }
};
