<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashbackplansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cashbackplans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('level_id');
            $table->bigInteger('level_name');
            $table->bigInteger('avg_monthly_user_pauchase');
            $table->bigInteger('avg_monthly_user_downline_pauchase');
            $table->float('levelwise_income_percentage', 8, 2);
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
        Schema::dropIfExists('cashbackplans');
    }
}
