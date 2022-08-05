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
        Schema::create('instruments', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->double('price');
            $table->string('photo');
            $table->text('description');
            $table->integer('quantity');
            $table->timestamps();
            $table->string('dimensions');
            $table->string('weight');
            $table->string('color');
            $table->float('rate')->nullable();
            $table->softDeletes();


            $table->foreignId('instrument_category_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('instruments');
    }
};
