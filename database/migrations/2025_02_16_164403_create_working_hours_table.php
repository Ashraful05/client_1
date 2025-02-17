<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('working_hours', function (Blueprint $table) {
            $table->id();
            $table->string('saturday')->nullable();
            $table->string('sunday')->nullable();
            $table->string('monday')->nullable();
            $table->string('tuesday')->nullable();
            $table->string('wednesday')->nullable();
            $table->string('thursday')->nullable();
            $table->string('friday')->nullable();
            $table->unsignedBigInteger('hospital_id'); // Foreign key
            $table->foreign('hospital_id')->references('id')->on('hospitals')->onDelete('cascade'); // Important!
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('working_hours');
    }
};
