<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHumanitarianAidHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('humanitarian_aid_histories', function (Blueprint $table) {
            $table->id();
            $table->string('index')->nullable();
            $table->string('full_name')->nullable();
            $table->string('passport')->nullable();
            $table->longText('description')->nullable();
            $table->timestamp('issue_at')->nullable();
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
        Schema::dropIfExists('humanitarian_aid_histories');
    }
}
