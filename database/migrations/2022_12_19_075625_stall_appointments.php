<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class StallAppointments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stall_appointments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger( 'seller_id');
            $table->unsignedBigInteger( 'stall_id');
            $table->unsignedBigInteger( 'seller_stall_id');
            $table->string( 'date');
            $table->string( 'status');
            $table->timestamps();

            $table->index( 'seller_id');
            $table->index( 'stall_id');
            $table->index( 'seller_stall_id');
        });
    }
        

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stall_appointments');
    }
}
