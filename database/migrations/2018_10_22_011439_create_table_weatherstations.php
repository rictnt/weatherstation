<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableWeatherstations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weatherstations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('code')->nullable();
            $table->string('province')->nullable();
            $table->string('owner')->nullable();
            $table->string('loc')->nullable();
            $table->string('lat')->nullable();
            $table->string('lon')->nullable();
            $table->string('alt')->nullable();
            $table->string('state')->nullable();
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
        Schema::dropIfExists('weatherstations');
    }
}
