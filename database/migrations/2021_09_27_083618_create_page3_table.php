<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePage3Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page3', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('desc');
            $table->string('title_section1');
            $table->text('desc_section1');
            $table->string('title_section2');
            $table->text('desc_section2');
            $table->string('title_section3');
            $table->text('desc_section3');
            $table->string('image1');
            $table->string('image2');
            $table->string('image3');
            $table->string('imageteam');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('page3');
    }
}
