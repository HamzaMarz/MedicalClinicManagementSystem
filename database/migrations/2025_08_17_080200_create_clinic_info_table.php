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
        Schema::create('clinic_info', function (Blueprint $table) {
            $table->id();
            $table->string('name');             // اسم العيادة
            $table->string('email');            // الايميل
            $table->string('phone');            // رقم الجوال
            $table->string('location');         // الموقع
            $table->string('logo')->nullable();
            $table->time('work_start');         // وقت بداية العمل
            $table->time('work_end');           // وقت نهاية العمل
            $table->json('work_days');          // أيام العمل (JSON)
            $table->text('description')->nullable(); // الوصف
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clinic_info');
    }
};
