<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumns2InPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->boolean('save_payment_method')->default(false)->after('payment_status');
            $table->integer('interval_days')->nullable()->after('save_payment_method');
            $table->dateTime('next_pay')->nullable()->after('interval_days');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn(['save_payment_method', 'interval_days', 'next_pay']);
        });
    }
}
