<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cases', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->bigInteger('makes_id')->unsigned()->nullable();
            $table->bigInteger('model_id')->unsigned()->nullable();
            $table->integer('mileage')->nullable();
            $table->dateTime('buying_date')->nullable();
            $table->bigInteger('color_id')->unsigned()->nullable();
            $table->string('picture')->nullable();
            $table->string('drive_options')->nullable();
            $table->boolean('full_fill')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onUpdate('set null')->onDelete('set null');
            $table->foreign('makes_id')->references('id')->on('makes')->onUpdate('set null')->onDelete('set null');
            $table->foreign('model_id')->references('id')->on('models')->onUpdate('set null')->onDelete('set null');
            $table->foreign('color_id')->references('id')->on('colors')->onUpdate('set null')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cases');
    }
}
