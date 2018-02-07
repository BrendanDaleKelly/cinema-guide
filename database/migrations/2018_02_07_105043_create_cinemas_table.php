<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCinemasTable extends Migration
{
    // Run the migrations.
    public function up()
    {
        Schema::create('cinemas', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->text('address');
            $table->text('url');
            $table->text('phone');
            $table->decimal('latitude', 8, 6);
            $table->decimal('longitude', 9, 6);
            $table->timestamps();
        });
    }

    // Reverse the migrations.
    public function down()
    {
        Schema::dropIfExists('cinemas');
    }
}
