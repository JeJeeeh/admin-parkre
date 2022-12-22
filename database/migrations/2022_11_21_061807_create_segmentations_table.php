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
        Schema::create('segmentations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->integer('park_space');
            $table->integer('reserve_space');
            $table->bigInteger('initial_price');
            $table->bigInteger('price');
            $table->foreignId('mall_id')->unsigned();
            $table->string('image_url')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('mall_id')->references('id')->on('malls');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('segmentations');
    }
};
