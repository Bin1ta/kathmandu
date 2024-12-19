<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('office_settings', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('नाम');
            $table->string('site_address')->nullable()->comment('साइट ठेगाना');
            $table->string('logo')->nullable()->comment('लोगो');
            $table->string('logo1')->nullable()->comment('लोगो1');
            $table->string('logo2')->nullable()->comment('लोगो2');
            $table->string('background_image')->nullable();
            $table->string('phone')->nullable()->comment('फोन');
            $table->string('email')->nullable()->comment('इमेल');
            $table->text('website')->nullable()->comment('वेबसाइट');
            $table->foreignId('province_id')->nullable()->comment('प्रदेश आईडी')->constrained()->nullOnDelete()->onUpdate('no action');
            $table->foreignId('district_id')->nullable()->comment('जिल्ला आईडी')->constrained()->nullOnDelete()->onUpdate('no action');
            $table->foreignId('local_body_id')->nullable()->comment('स्थानीय निकाय आईडी')->constrained()->nullOnDelete()->onUpdate('no action');
            $table->string('ward_no')->nullable()->comment('वार्ड नं');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('office_settings', function (Blueprint $table) {
            $table->dropColumn('ward');
        });
    }
};
