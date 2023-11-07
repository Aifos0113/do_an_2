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
        Schema::create('tenacies', function (Blueprint $table) {
            $table->id();
            $table->string('tenacy_id', 100)->unique();
            $table->date('start_day');
            $table->string('personal_id');
            $table->integer('phone_number');
            $table->date('end_date');
            $table->string('room_code', 100);
            $table->integer('amount_of_people');
            $table->decimal('price',10,3);
            $table->string('rule', 500);
            $table->boolean('is_active')->default(true);
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
        Schema::dropIfExists('tenacies');
    }
};
