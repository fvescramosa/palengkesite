<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToStallAppointmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stall_appointments', function (Blueprint $table) {
            $table->string('application_letter')->nullable();
            $table->string('residency')->nullable();
            $table->string('image')->nullable();
            $table->string('id1')->nullable();
            $table->string('id2')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stall_appointments', function (Blueprint $table) {
            //
        });
    }
}
