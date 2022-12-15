<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellerStallsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seller_stalls', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger( 'seller_id');
            $table->unsignedBigInteger( 'stall_id');
            $table->string( 'start_date')->nullable();
            $table->string( 'end_date')->nullable();
            $table->string( 'duration')->nullable();
            $table->string( 'occupancy_fee')->nullable();
            $table->string( 'status')->nullable();
            $table->timestamps();
            $table->index( 'seller_id');
            $table->index( 'stall_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seller_stalls');
    }
}
