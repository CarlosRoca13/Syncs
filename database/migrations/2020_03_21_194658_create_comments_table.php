<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('clientId');
            $table->unsignedBigInteger('sheetId');
            $table->date('dateTime');
            $table->string('description');
            $table->unsignedBigInteger('response')->nullable();
            $table->integer('likes')->unsigned();
            $table->integer('dislikes')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('clientId')->references('id')->on('clients');
            $table->foreign('sheetId')->references('id')->on('sheets');
            $table->foreign('response')->references('id')->on('comments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
