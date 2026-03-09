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
        Schema::create('certifications', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('scheme_id');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('assessor_id')->nullable()->constrained('users')->onDelete('set null');
            $table->enum('status', ['pending', 'kompeten', 'belum_kompeten'])->default('pending');
            $table->date('execution_date')->nullable();
            $table->timestamps();

            $table->foreign('scheme_id')->references('id')->on('schemes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certifications');
    }
};
