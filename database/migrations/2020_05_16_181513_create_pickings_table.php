<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePickingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pickings', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id')->default(0);
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->string('article')->nullable();
            $table->double('price')->nullable();
            $table->text('description')->nullable();
            $table->integer('position')->default(1);
            $table->integer('views')->default(0);
            $table->boolean('active')->default(1);
            $table->text('path')->nullable();
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
        Schema::dropIfExists('pickings');
    }
}
