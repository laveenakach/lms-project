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
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('course_id')->constrained()->onDelete('cascade');

            // Invoice Info
            $table->string('invoice_number')->unique();
            $table->date('invoice_date');
            $table->date('due_date')->nullable();

            // Pricing Fields
            $table->decimal('subtotal', 10, 2)->default(0);

            // Discount
            $table->decimal('discount_percent', 5, 2)->default(0);
            $table->decimal('discount_amount', 10, 2)->default(0);

            // CGST
            $table->decimal('cgst_percent', 5, 2)->default(0);
            $table->decimal('cgst_amount', 10, 2)->default(0);

            // SGST
            $table->decimal('sgst_percent', 5, 2)->default(0);
            $table->decimal('sgst_amount', 10, 2)->default(0);

            // Total GST
            $table->decimal('total_tax_percent', 5, 2)->default(0); // (CGST + SGST)
            $table->decimal('total_tax_amount', 10, 2)->default(0); // (CGST + SGST amount)

            // Convenience Fees
            $table->decimal('convenience_fee_percent', 5, 2)->default(0);
            $table->decimal('convenience_fee_amount', 10, 2)->default(0);

            // Final Total
            $table->decimal('grand_total', 10, 2)->default(0);

            // Payment Details
            $table->enum('status', ['unpaid', 'paid'])->default('unpaid');
            $table->date('payment_date')->nullable();
            $table->string('payment_method')->nullable(); // UPI, Card, Netbanking etc.
            $table->string('transaction_id')->nullable(); // Razorpay payment ID

            // PDF Invoice Path
            $table->string('pdf_path')->nullable();
            $table->timestamps();
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
