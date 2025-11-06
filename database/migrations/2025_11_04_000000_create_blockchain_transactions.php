<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlockchainTransactions extends Migration
{
    public function up()
    {
        Schema::create('blockchain_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('oferta_id')->nullable();
            $table->string('empresa')->nullable();
            $table->bigInteger('price')->nullable(); // store cents (integer)
            $table->string('tx_hash')->nullable()->index();
            $table->string('chain')->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('blockchain_transactions');
    }
}
