<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSheltersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shelters', function (Blueprint $table) {
            $table->id();
            $table->string('city')->nullable();
            $table->string('region')->nullable();
            $table->string('address', 400);
            $table->double('lat')->default(0);
            $table->double('lon')->default(0);
            $table->string('balance_holder')->nullable();
            $table->string('responsible_person')->nullable();
            $table->integer('capacity')->default(0);
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
        Schema::dropIfExists('shelters');
    }
}
