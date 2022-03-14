<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sliders', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_id')->default(0);
            $table->integer('picking_id')->nullable();
            $table->string('title');
            $table->string('alias')->nullable();
            $table->string('youtube_url')->nullable();
            $table->text('description')->nullable();
            $table->string('url', 400)->nullable();
            $table->string('button_text', 40)->nullable();
            $table->boolean('active')->default(true);
            $table->integer('position')->default(1);
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
        Schema::dropIfExists('sliders');
    }
}
