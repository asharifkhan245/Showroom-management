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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('brand');
            $table->string('model');
            $table->integer('made_year');
            $table->string('horse_power');
            $table->string('title');
            $table->string('number_plate');
            $table->string('chassis_number');
            $table->string('engine_number');
            $table->integer('cost');
            $table->string('price');
            $table->string('car_report_doc');
            $table->string('condition_description');
            $table->json('images')->nullable();
            $table->json('features')->nullable();
            $table->enum('status', ['sold', 'available'])->default('available');
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
        Schema::dropIfExists('cars');
    }
};
