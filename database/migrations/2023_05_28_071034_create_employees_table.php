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
            $table->string('name')->comment('नाम');
            $table->string('department')->nullable()->comment('विभाग');
            $table->string('designation')->nullable()->comment('पदनाम');
            $table->string('photo')->nullable()->comment('फोटो');
            $table->string('email')->nullable()->comment('इमेल');
            $table->string('phone')->nullable()->comment('फोटो');
            $table->foreignId('employee_id')->nullable()->constrained()->nullOnDelete()->onUpdate('no action');
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete()->onUpdate('no action');
            $table->integer('position')->nullable()->comment('स्थान');
            $table->boolean('status')->default(true)->comment('स्थिति');
            $table->boolean('is_employee')->default(true)->comment('कर्मचारी ');
            $table->boolean('show_to_mobile_app')->default(false)->comment('मोबाइल एपमा देखाउने');
            $table->boolean('show_to_index')->default(true)->comment('index मा देखाउने ');
            $table->string('ward')->nullable();
            $table->softDeletes();
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
