<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pitches', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->string('subtitle');
            $table->longText('description');
            $table->string('img');
            $table->tinyInteger('difficulty');
            $table->decimal('lat', 8,6);
            $table->decimal('lng', 8,6);
            $table->tinyInteger('verified')->default(0);
            $table->timestamps();

            $table->index('lat');
            $table->index('lng');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pitches');
    }
};
