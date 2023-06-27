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
        Schema::create('pots', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('name');
            $table->text('description')->nullable();
            $table->boolean('is_private')->nullable();
            $table->float('amount', 10, 2)->default('0.00');
            $table->float('goal', 10, 2);
            $table->enum('status', ['open', 'closed'])->default('open');
            $table->string('cover_photo_path', 2048)->default('Images/jx7GSSmQaSohWSwhBfWj9WIJPMVe9KPVClSv1RSw.jpg');
            $table->string('accent_colour')->nullable();
            $table->boolean('is_auto_closing')->nullable();
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
        Schema::table('pots', function (Blueprint $table) {
            $table->dropForeign('user_id');
        });
        Schema::dropIfExists('pots');
    }
};
