<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('depositions', function (Blueprint $table) {

            $table->id();
            $table->timestamps();
            $table->string('conceptrecid');
            $table->string('doi');
            $table->string('doi_url');
            $table->timestamp('created')->nullable();
            $table->timestamp('modified')->nullable();
            $table->bigInteger('owner');
            $table->bigInteger('record_id');
            $table->string('state');
            $table->boolean('submitted');

            // metadata
            $table->string('access_right');
            $table->string('title');
            $table->text('description');
            $table->string('license');
            $table->string('upload_type');

            // foreign id
            $table->foreignId('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('depositions');
    }
}
