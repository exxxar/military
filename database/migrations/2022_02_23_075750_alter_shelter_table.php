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
        Schema::table('shelters', function (Blueprint $table) {
          $table->integer("status")->default(\App\Enums\ShelterStatusEnum::NOT_VERIFIED->value);
          $table->integer("quality")->default(\App\Enums\QualityStateEnum::UNKNOWN->value);
          $table->integer("type")->default(\App\Enums\ShelterTypeEnum::REFUGE->value);
          $table->json("facility")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shelters', function (Blueprint $table) {
            $table->dropColumn("status");
            $table->dropColumn("quality");
            $table->dropColumn("type");
            $table->dropColumn("facility");
        });
    }
};
