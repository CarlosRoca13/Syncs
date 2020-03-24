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
            $table->unsignedBigInteger('sheets_id');
            $table->string('instrument');
            $table->string('effects');
            $table->string('pdf');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('sheets_id')->references('id')->on('sheets');

            $table->unique(['sheets_id', 'instrument']);
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
