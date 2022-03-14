<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttributesPickingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attributes_pickings', function (Blueprint $table) {
            $table->integer('attribute_id')->index()->unsigned();
            $table->integer('picking_id')->index()->unsigned();
            $table->integer('option_id')->default(0);
            $table->text('value')->nullable();

            /*$table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('attribute_id')->references('id')->on('attributes')->onDelete('cascade');*/
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('attributes_pickings', function(Blueprint $table) {
            /*$table->dropPrimary('attribute_id');
            $table->dropPrimary('option_id');*/
        });
    }
}
