<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video', function (Blueprint $table) {
            $table->id();
            $table->string('link');
            $table->string('thumb');
            $table->string('title');
            $table->string('desc');
            $table->string('title_section1');
            $table->text('desc_section1');
            $table->string('title_section2');
            $table->text('desc_section2');
            $table->string('title_section3');
            $table->text('desc_section3');
            $table->string('imageanimasi');
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
        Schema::dropIfExists('video');
    }
}
