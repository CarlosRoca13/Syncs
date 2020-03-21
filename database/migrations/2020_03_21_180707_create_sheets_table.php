<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSheetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sheets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('clientId');
            $table->string('description');
            $table->string('key');
            $table->string('mainGenre');
            $table->unsignedBigInteger('likes');
            $table->unsignedBigInteger('dislikes');
            $table->unsignedBigInteger('views');
            $table->unsignedBigInteger('downloads');
            $table->string('image');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('clientId')->references('id')->on('clients');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sheets');
    }
}
