<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('customer_id');
            $table->integer('room_type_id');
            $table->integer('no_of_rooms');
            $table->integer('no_of_persons');
            $table->double('amount');
            $table->string('transaction_ref');
            $table->date('check_in_date');
            $table->date('check_out_date');
            $table->boolean('checked_in')->default(false);
            $table->boolean('checked_out')->default(false);
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
        Schema::dropIfExists('bookings');
    }
}
