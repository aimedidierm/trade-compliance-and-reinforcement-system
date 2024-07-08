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
        Schema::create('declarations', function (Blueprint $table) {
            $table->id();
            $table->string('address');
            $table->float('quantity');
            $table->float('price');
            $table->float('weight');
            $table->string('status');
            $table->unsignedBigInteger("user_id");
            $table->foreign("user_id")->on("users")->references("id");
            $table->unsignedBigInteger("product_id");
            $table->foreign("product_id")->on("products")->references("id");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('declarations');
    }
};
