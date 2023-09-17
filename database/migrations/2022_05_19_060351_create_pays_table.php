<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pays', function (Blueprint $table) {
            $table->id();
            $table->text('identifiant');
            $table->text('title');
            $table->timestamps();
        });

        Schema::table('pays_voyage', function(Blueprint  $table){
            $table->integer('pays_id')->unsigned()->index()->nullable();
        });

        Schema::table('photos', function(Blueprint  $table){
            $table->integer('pays_id')->unsigned()->index();
        });

        Schema::table('albums', function(Blueprint  $table){
            $table->integer('pays_id')->unsigned()->index()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pays');
    }
}
