<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competition_user', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('category');
            $table->integer('target_number')->nullable();
            $table->integer('distance');
            $table->integer('points')->nullable();
            $table->string('target_letter')->nullable();
            $table->foreignId('competition_id')->references('id')->on('competitions');
            $table->foreignId('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('competition_user');
    }
};
