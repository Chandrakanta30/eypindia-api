<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsertreesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usertrees', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->bigInteger('p1');
            $table->bigInteger('p2');
            $table->bigInteger('p3');
            $table->bigInteger('p4');
            $table->bigInteger('p5');
            $table->bigInteger('p6');
            $table->bigInteger('p7');
            $table->bigInteger('p8');
            $table->bigInteger('p9');
            $table->bigInteger('p10');

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
        Schema::dropIfExists('usertrees');
    }
}
