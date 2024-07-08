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
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table->string('packaging_number');
            $table->string('currier');
            $table->string('ship_via');
            $table->date('date');
            $table->string('address');
            $table->string('tracking_number');
            $table->string('status');
            $table->unsignedBigInteger("sale_id");
            $table->foreign("sale_id")->on("sales")->references("id");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipments');
    }
};
