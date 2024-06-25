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
        Schema::create('dishes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('restaurant_id')
            ->constrained()
            ->onDelete('cascade');
            $table->string('dish_name');
            $table->string('dish_slug');
            $table->string('dish_photo')->nullable();
            $table->boolean('is_visible')->default(true);
            $table->decimal('price', 5, 2);
            $table->text('description')->nullable();
            $table->boolean('is_vegetarian')->default(false);
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
        Schema::dropIfExists('dishes');
    }
};
