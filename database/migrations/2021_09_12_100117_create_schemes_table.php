<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchemesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schemes', function (Blueprint $table) {
            $table->id();
            $table->char('scheme_name',100);
            $table->bigInteger('customer_id');
            $table->bigInteger('agent_id');
            $table->bigInteger('scheme_number');
            $table->date('start_date');
            $table->date('marurity_date');
            $table->double('amount',10,2);
            $table->enum('payment_mode',['online','bank_transfer','cod']);
            $table->enum('status',[1,0]);


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
        Schema::dropIfExists('schemes');
    }
}
