<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('fname')->nullable();
            $table->string('sname')->nullable();
            $table->string('tname')->nullable();
            $table->string('birth')->nullable();
            $table->integer('age_from')->default(0)->nullable();
            $table->integer('age_to')->default(0)->nullable();
            $table->tinyInteger('sex')->default(0);
            $table->json('photos')->nullable();
            $table->json('phones')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('people_id')->nullable();
            $table->string('city')->nullable();
            $table->string('region')->nullable();
            $table->string('address')->nullable();
            $table->longText('story')->nullable();
            $table->longText('description')->nullable();
            $table->integer('status')->default(0);
            $table->integer('for')->default(0);
            $table->timestamp('searched_from')->nullable();
            $table->boolean('is_active')->default(true);
            $table->softDeletes();
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
        Schema::dropIfExists('people');
    }
}
