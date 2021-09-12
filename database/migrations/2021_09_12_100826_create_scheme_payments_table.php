<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchemePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scheme_payments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('scheme_id');
            $table->double('payment_amount',10,2);
            $table->enum('payment_mode',['online','bank_transfer','cod']);
            $table->enum('status',['paid','unpaid']);
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
        Schema::dropIfExists('scheme_payments');
    }
}
