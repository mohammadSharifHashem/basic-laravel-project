<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->bigIncrements('country_id');
            $table->unsignedBigInteger('continent_id')->nullable();
            $table->string('name', 128)->nullable();

            $table->unsignedTinyInteger('status');
            $table->datetime('added_date');
            $table->datetime('updated_date');

            $table->foreign('continent_id')->references('continent_id')->on('continents');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('countries');
    }
}
