<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSheetInstrumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sheet_instruments', function (Blueprint $table) {
            $table->unsignedBigInteger('sheetId');
            $table->string('instrument');
            $table->string('effects');
            $table->string('pdf');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('sheetId')->references('id')->on('sheets');

            $table->unique(['sheetId', 'instrument']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sheet_instruments');
    }
}
