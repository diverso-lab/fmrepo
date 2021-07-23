<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestreviewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviewrequests', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('email')->nullable();
            $table->boolean('type_journal')->nullable();
            $table->boolean('type_conference')->nullable();
            $table->boolean('type_workshop')->nullable();
            $table->boolean('type_tool')->nullable();
            $table->string('doi_journal')->nullable();
            $table->string('doi_conference')->nullable();
            $table->string('doi_workshop')->nullable();
            $table->string('doi_tool')->nullable();
            $table->foreignId('dataset_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviewrequests');
    }
}
