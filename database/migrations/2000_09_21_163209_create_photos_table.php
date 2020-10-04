<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->default('defaut.png');
            $table->timestamps();
        });

        Schema::table('comments', function(Blueprint  $table){
            $table->integer('photos_id')->unsigned()->index()->nullable();
        });

        Schema::table('etiquettes-photos', function(Blueprint $table){
            $table->integer('photo_id')->unsigned()->index()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('photos');
    }
}
