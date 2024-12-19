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
        Schema::create('headers', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('शीर्षक');
            $table->string('font')->nullable()->comment('फन्ट');
            $table->string('font_size')->nullable()->comment('फन्ट साइज');
            $table->string('position')->nullable()->comment('स्थान');
            $table->string('font_color')->nullable()->comment('फन्ट रङ');
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
        Schema::dropIfExists('headers');
    }
};
