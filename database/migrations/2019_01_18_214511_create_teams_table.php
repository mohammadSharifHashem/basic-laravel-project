<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function(Blueprint $table) {
            $table->bigIncrements('team_id');
            $table->unsignedBigInteger('country_id')->nullable();
            $table->string('name', 128)->nullable();
            $table->string('short_code', 16)->nullable();
            $table->boolean('is_national_team');
            $table->unsignedInteger('founded_year')->nullable();

            $table->unsignedTinyInteger('status');
            $table->datetime('added_date');
            $table->datetime('updated_date');

            $table->foreign('country_id')->references('country_id')->on('countries');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teams');
    }
}
