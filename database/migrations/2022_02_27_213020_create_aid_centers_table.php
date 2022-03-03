<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAidCentersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aid_centers', function (Blueprint $table) {
            $table->id();
            $table->string('city')->nullable();
            $table->string('region')->nullable();
            $table->string('address', 400)->nullable();
            $table->string('phone', 100)->nullable();
            $table->longText('required')->nullable();
            $table->longText('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aid_centers');
    }
}
