<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHw2likesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hw2likes', function (Blueprint $table) {
            $table->unsignedBigInteger("id");
            $table->string("username");
            $table->timestamps();
            $table->foreign('username')->references('username')->on("users");
            $table->foreign('id')->references('id')->on("posts");
            $table->primary(['id','username']);
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
        Schema::dropIfExists('hw2likes');
    }
}
