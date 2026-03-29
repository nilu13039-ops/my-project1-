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
        Schema::create('tables', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g., "Masa 1", "VIP 1"
            $table->integer('capacity')->default(2);
            $table->enum('status', ['available', 'reserved', 'occupied'])->default('available');
            $table->string('location')->nullable(); // e.g., "Inside", "Terrace"
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tables');
    }
};
