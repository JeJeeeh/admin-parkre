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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->dateTime('verified_at')->nullable();
            $table->string('password');
            $table->string('address')->nullable();
            $table->string('phone');
            $table->bigInteger('balance')->default(0);
            $table->string('fcm_token')->nullable();
            $table->string('image_url')->nullable();
            $table->integer('otp')->nullable()->unsigned()->max(999999)->unique();
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
        Schema::dropIfExists('users');
    }
};
