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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('pot_id');
            $table->foreign('pot_id')->references('id')->on('pots')->onDelete('cascade');
            $table->float('amount', 10, 2);
            $table->string('reference')->nullable();
            $table->string('addition_or_withdrawal');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropForeign('user_id');
            $table->dropForeign('pot_id');
        });
        Schema::dropIfExists('transactions');
    }
};
