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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->decimal('additionalCharges', 10, 2);
            $table->decimal('totalAmount', 10, 2);
            $table->timestamps();
            $table->foreignId('repair_id')->constrained('repairs')->onDelete('cascade');
    
            // Define foreign key constraint
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};