<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public $tableLists;

    public function __construct()
    {
        $this->tableLists = collect([
            "videos",
            "employees",
            "notices",
            "branches",
            "citizen_charters",
            "revenues",
            "popup_settings",
            "programs",
        ]);
    }

    public function up(): void
    {
        $this->tableLists->each(function ($tableName) {
            Schema::table($tableName, function (Blueprint $table) {
                $table->boolean('is_displayed')->default(false);
            });
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $this->tableLists->each(function ($tableName) {
            Schema::table($tableName, function (Blueprint $table) {
                $table->dropColumn('is_displayed');
            });
        });
    }
};
