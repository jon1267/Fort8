<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBiddingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bidding', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('instrument_id');
            $table->date('trade_at');
            $table->bigInteger('price');
            $table->bigInteger('volume');
            $table->string('description')->nullable();
            $table->string('display')->nullable();
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
        Schema::dropIfExists('bidding');
    }
}
