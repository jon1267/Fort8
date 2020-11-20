<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndexToBiddingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bidding', function (Blueprint $table) {
            $table->index(['instrument_id', 'trade_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bidding', function (Blueprint $table) {
            $table->dropIndex('bidding_instrument_id_trade_at_index'); //кажется так, но не проверял
        });
    }
}
