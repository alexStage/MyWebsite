<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('familyName');
            $table->string('pseudo')->unique();
            $table->string('email')->unique();
            $table->longtext('description')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('photoSlug')->default('assets/default-user-icon.jpg');
            $table->boolean('admin')->default(false);
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::table('albums', function(Blueprint  $table){
            $table->integer('user_id')->unsigned()->index();
        });

        Schema::table('comments',function(Blueprint $table){
            $table->integer('user_id')->unsigned()->index();
        });

        Schema::table('photos', function(Blueprint $table){
            $table->integer('user_id')->unsigned()->index()->nullable();
        });

        Schema::table('user_voyage', function(Blueprint  $table){
            $table->integer('user_id')->unsigned()->index()->nullable();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
