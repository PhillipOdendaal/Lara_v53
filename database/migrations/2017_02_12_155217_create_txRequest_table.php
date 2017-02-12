<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTxRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('txrequests', function (Blueprint $table) {
            $table->increments('id');
            $table->text('tx_name');
            $table->mediumText('tx_description');
            $table->mediumText('tx_path');
            $table->mediumText('tx_head');
            $table->binary('tx_payload', 1000)->nullable();
            $table->integer('status')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('txrequests');
    }
}
