<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlaylistItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('playlist_items', function (Blueprint $table) {
            $table->unsignedBigInteger('playlists_id');
            $table->unsignedBigInteger('sheets_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('playlists_id')->references('id')->on('playlists');
            $table->foreign('sheets_id')->references('id')->on('sheets');
            $table->unique(['playlists_id', 'sheets_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('playlist_items');
    }
}
