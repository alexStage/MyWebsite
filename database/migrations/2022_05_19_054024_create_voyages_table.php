<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVoyagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voyages', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->longtext('description');
            $table->date('dateDeDebut');
            $table->date('dateDeFin');
            $table->timestamps();
        });

        Schema::table('albums', function(Blueprint  $table){
            $table->integer('voyage_id')->unsigned()->index();
        });

        Schema::table('pays_voyage', function(Blueprint  $table){
            $table->integer('voyage_id')->unsigned()->index()->nullable();
        });

        Schema::table('user_voyage', function(Blueprint  $table){
            $table->integer('voyage_id')->unsigned()->index()->nullable();
        });

    }

    

    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('voyages');
    }
}
