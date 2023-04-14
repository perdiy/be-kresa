<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAboutTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('about', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->string('image1');
            $table->string('image2');
            $table->string('image3');
            $table->char('title_section1');
            $table->char('desc_section1');
            $table->char('title_section2');
            $table->char('desc_section2');
            $table->char('title_section3');
            $table->char('desc_section3');
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
        Schema::dropIfExists('about');
    }
}
