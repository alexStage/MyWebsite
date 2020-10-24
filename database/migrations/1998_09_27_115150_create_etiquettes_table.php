<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEtiquettesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('etiquettes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('name');
        });

        Schema::table('etiquette_photo', function(Blueprint $table){
            $table->integer('etiquette_id')->unsigned()->index()->nullable();
        });

        Schema::table('etiquette_album', function(Blueprint $table){
            $table->integer('etiquette_id')->unsigned()->index()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('etiquettes');
    }
}
