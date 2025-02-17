<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('agent_id');
            $table->unsignedBigInteger('candidate_id');
            $table->string('transaction_id')->unique();
            $table->string('payment_status');
            $table->decimal('amount', 10, 2); // Use decimal for currency
            $table->date('date');
            $table->foreign('agent_id')->references('id')->on('agents');
            $table->foreign('candidate_id')->references('id')->on('candidates');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
