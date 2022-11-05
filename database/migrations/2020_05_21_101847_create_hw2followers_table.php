<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHw2followersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hw2followers', function (Blueprint $table) {
            $table->string("user_follower");
            $table->string("user_followed");
            $table->timestamps();
            $table->foreign('user_follower')->references('username')->on("users");
            $table->foreign('user_followed')->references('username')->on("users");
            $table->primary(['user_follower','user_followed']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('hw2followers');
    }
}

