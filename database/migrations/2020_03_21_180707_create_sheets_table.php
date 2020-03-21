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
            $table->integer('likes')->unserialize();
            $table->integer('dislikes')->unserialize();
            $table->integer('views')->unserialize();
            $table->integer('downloads')->unserialize();
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
