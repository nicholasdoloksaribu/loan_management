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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            $table->date('transaction_date');
            $table->foreignId('loan_id')->constrained('loans');

            $table->foreignId('customer_id')->constrained('customers');
            $table->string('customer_name');

            $table->string('currency_id', 10);
            $table->foreign('currency_id')->references('currency_id')->on('currencies');
            $table->string('currency_name');

            $table->decimal('paid_amount', 15, 2);
            $table->decimal('os_balance', 15, 2);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
