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
        Schema::create('fmembers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('relationship')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('occupation')->nullable();
            $table->string('phone_no')->nullable();
            $table->string('address')->nullable();
            $table->foreignId('employee_id')->constrained('employees')->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fmembers');
    }
};
