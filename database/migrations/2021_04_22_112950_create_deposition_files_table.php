<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepositionFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deposition_files', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('checksum');
            $table->string('filename');
            $table->integer('filesize');
            $table->string('file_id');
            $table->string('download_link');
            $table->string('self_link');
            $table->foreignId('deposition_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deposition_files');
    }
}
