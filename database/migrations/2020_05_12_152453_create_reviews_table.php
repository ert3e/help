<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->integer('item_id')->nullable();
            $table->string('item_type')->nullable();
            $table->string('name')->nullable();
            $table->string('date')->nullable();
            $table->string('city')->nullable();
            $table->string('age')->nullable();
            $table->text('review')->nullable();
            $table->text('answer')->nullable();
            $table->string('youtube_url')->nullable();
            $table->integer('rating')->default(5);
            $table->boolean('active')->default(1);
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
        Schema::dropIfExists('reviews');
    }
}
