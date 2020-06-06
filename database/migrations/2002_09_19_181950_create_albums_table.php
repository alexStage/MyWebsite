<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlbumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() 
    {
        Schema::create('albums', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('title');
            $table->longtext('content');
            $table->timestamps();
        });

        Schema::table('photos', function(Blueprint $table){
            $table->integer('album_id')->integer()->index();
        });

        Schema::table('comments', function(Blueprint  $table){
            $table->integer('album_id')->unsigned()->index()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('albums');
    }
}
