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
        Schema::create('claims', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_insurance_id')->constrained('patient_insurances')->onDelete('cascade'); // تأمين المريض
            $table->foreignId('invoice_id')->constrained('invoices')->onDelete('cascade'); // الفاتورة المرتبطة
            $table->text('service_description'); // الخدمة/التشخيص
            $table->decimal('claim_amount', 10, 2); // المبلغ المطلوب تغطيته
            $table->enum('status', ['Pending', 'Approved', 'Rejected', 'Paid'])->default('Pending'); // حالة المطالبة
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('claims');
    }
};
