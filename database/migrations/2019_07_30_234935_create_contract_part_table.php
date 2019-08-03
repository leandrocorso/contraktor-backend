<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractPartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts_parts', function (Blueprint $table) {
            $table->integer('contracts_id')->unsigned();
            $table->integer('parts_id')->unsigned();

            $table->foreign('contracts_id')
                ->references('id')
                ->on('contracts')
                ->onDelete('cascade');

            $table->foreign('parts_id')
                ->references('id')
                ->on('parts')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contract_part');
    }
}
