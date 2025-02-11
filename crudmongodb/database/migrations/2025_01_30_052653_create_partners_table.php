<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('partners', function (Blueprint $table) {
            $table->id();
            $table->string('first_name',60);
            $table->string('last_name',60)->nullable();
            $table->string('phone_number',20)->nullable();
            $table->string('movil',20)->nullable();
            $table->date('birthday')->nullable();
            $table->tinyInteger('age')->unsigned()->nullable();
            $table->enum('sex',['female','male'])->nullable();
            $table->string('street',100)->nullable();
            $table->string('noExt',20)->nullable();
            $table->string('noInt',20)->nullable();
            $table->string('colony',100)->nullable();
            $table->string('postal_code',10)->nullable();
            $table->bigInteger('user_id')->unsigned();
            $table->smallInteger('country_id')->unsigned()->nullable();
            $table->mediumInteger('state_id')->unsigned()->nullable();
            $table->mediumInteger('city_id')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('user_id')->references('id')
					->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('country_id')->references('id')
					->on('countries')->onDelete('set null')->onUpdate('set null');
            $table->foreign('state_id')->references('id')
					->on('states')->onDelete('set null')->onUpdate('set null');
            $table->foreign('city_id')->references('id')
					->on('cities')->onDelete('set null')->onUpdate('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partners');
    }
};
