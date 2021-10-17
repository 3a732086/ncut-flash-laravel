<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGreenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('green', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('Verb')->nullable();
            $table->text('Noun')->nullable();
            $table->text('Adjective')->nullable();
            $table->text('Adverb')->nullable();
            $table->string('Count')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('green');
    }
}
