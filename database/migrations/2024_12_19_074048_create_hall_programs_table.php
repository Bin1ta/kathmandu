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
        Schema::create('hall_programs', function (Blueprint $table) {
            $table->id();
            $table->string('program_name');
            $table->string('program_detail');
            $table->string('program_date');
            $table->string('program_time_to');
            $table->string('program_time_from');
            $table->longText('remarks');
            $table->boolean('status')->default(true);
            $table->boolean('is_displayed')->default(false);
            $table->string('ward')->nullable();
            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete();

            // $table->foreignId('hall_id')->nullable()->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hall_programs');
    }
};
