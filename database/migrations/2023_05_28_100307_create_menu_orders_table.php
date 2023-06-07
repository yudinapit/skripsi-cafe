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
        Schema::create('menu_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tables_id');
            $table->string('price_total');
            $table->string('qty_total');
            $table->string('total_service_charge');
            $table->string('total_pb1');
            $table->string('payment_method')->nullable();
            $table->integer('status')->comment('1 => Belum Diproses, 2 => Sudah Diproses, 3 Dibayar, 4 Selesai');
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
        Schema::dropIfExists('menu_orders');
    }
};
