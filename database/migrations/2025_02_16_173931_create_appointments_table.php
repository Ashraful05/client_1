<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->string('merchant_reference')->unique();
            $table->string('gcc_slip_no')->nullable();
            $table->unsignedBigInteger('candidate_id');
            $table->unsignedBigInteger('agent_id');
            $table->date('entry_date');
            $table->date('validity_date');
            $table->unsignedBigInteger('payment_id')->unique(); // Make payment_id unique
            $table->foreign('candidate_id')->references('id')->on('candidates');
            $table->foreign('agent_id')->references('id')->on('agents');
            $table->foreign('payment_id')->references('id')->on('payments');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
