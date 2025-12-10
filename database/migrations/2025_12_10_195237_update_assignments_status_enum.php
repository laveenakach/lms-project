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
        Schema::table('assignments', function (Blueprint $table) {
        // Update ENUM values
        $table->enum('status', ['Assigned', 'Submitted', 'Checked', 'Approved', 'Rejected'])
              ->default('Assigned')
              ->change();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('assignments', function (Blueprint $table) {
        // Revert ENUM if needed
        $table->enum('status', ['Submitted', 'Checked', 'Approved', 'Rejected'])
              ->default('Submitted')
              ->change();
    });
    }
};
