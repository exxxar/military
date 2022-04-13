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
        Schema::table("humanitarian_aid_histories",function (Blueprint $table) {
            $table->json("issue_date_history")->nullable()->after("issue_at");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("humanitarian_aid_histories",function (Blueprint $table) {
            $table->dropColumn("issue_date_history");
        });
    }
};
