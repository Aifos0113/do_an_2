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
        Schema::create('pays', function (Blueprint $table) {
            $table->id();
            $table->date('thang');
            $table->string('room_code');
            $table->integer('tien_phong');
            $table->integer('so_dien');
            $table->integer('tien_nuoc');
            $table->integer('tien_mang');
            $table->integer('tien_khac');
            $table->integer('tong_tien');
            $table->string('note' , '255');
            $table->integer('da_thanh_toan');
            $table->string('tanancy' , 100);
            $table->integer('is_active')->default('1');
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
        Schema::dropIfExists('pays');
    }
};
