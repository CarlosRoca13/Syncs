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
            $table->unsignedBigInteger('playlistId');
            $table->unsignedBigInteger('sheetId');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('playlistId')->references('id')->on('playlists');
            $table->foreign('sheetId')->references('id')->on('sheets');
            $table->unique(['playlistId', 'sheetId']);
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
