<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoansDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('loan_id');
            $table->integer('period');
            $table->text('purpose');
            $table->text('description');
            $table->string('credit_level');
            $table->double('apr');
            $table->integer('pgr');
            
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
        Schema::dropIfExists('loans_detail');
    }
}
