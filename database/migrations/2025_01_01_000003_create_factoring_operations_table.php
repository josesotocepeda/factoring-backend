<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('factoring_operations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invoice_id')->constrained('invoices')->cascadeOnDelete();
            $table->decimal('advance_rate', 5, 2); // %
            $table->decimal('fee_rate', 5, 2); // %
            $table->decimal('advance_amount', 15, 2);
            $table->decimal('fee_amount', 15, 2);
            $table->decimal('settlement_amount', 15, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('factoring_operations');
    }
};
