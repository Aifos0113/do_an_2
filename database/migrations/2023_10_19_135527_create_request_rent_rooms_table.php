<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_rent_rooms', function (Blueprint $table) {
            $table->id();
            $table->string('room_code' , 10);
            $table->date('start_date');
            $table->date('end_date');
            $table->string('customer');
            $table->integer('price');
            $table->string('personal_id' , 20);
            $table->string('phone_number' , 20);
            $table->string('amount_of_people' , 2);
            $table->string('note' , 255);
            $table->boolean('is_active')->default('true');
            $table->integer('status')->default('1');
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
        Schema::dropIfExists('request_rent_rooms');
    }
};
