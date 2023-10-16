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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name_e')->nullable();
            $table->string('name_m')->nullable();
            $table->string('father_name');
            $table->date('date_of_birth')->nullable();
            $table->string('race');
            $table->string('religion');
            $table->string('nationality');
            $table->string('vacancy');
            $table->string('passport_no')->unique();
            $table->string('driver_license')->unique();
            $table->string('gender');
            $table->string('blood');
            $table->string('marital');
            $table->string('hphone_no')->unique();
            $table->string('phone_no')->unique();
            $table->string('url');
            $table->foreignId('nrcs_id')->constrained('nrcs')->cascadeOnDelete();//1-14
            $table->foreignId('nrcs_n')->constrained('nrcs')->cascadeOnDelete();//BaKala
            $table->string('type');//N P
            $table->integer('nrc_num')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
