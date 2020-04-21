<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDislikedSongsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disliked_songs', function (Blueprint $table) {
            $table->unsignedBigInteger('clients_id');
            $table->unsignedBigInteger('sheets_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('clients_id')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('sheets_id')->references('id')->on('sheets')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('disliked_songs');
    }
}
