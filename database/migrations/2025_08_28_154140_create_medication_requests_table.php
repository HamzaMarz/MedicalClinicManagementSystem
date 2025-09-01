<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(){
        Schema::create('medication_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medication_id')->constrained()->onDelete('cascade'); // الدواء المطلوب
            $table->unsignedBigInteger('admin_id'); // الأدمن اللي عمل الطلب
            $table->unsignedBigInteger('supervisor_id')->nullable(); // المشرف اللي بيرد
            $table->integer('requested_quantity'); // الكمية المطلوبة
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medication_requests');
    }
};
