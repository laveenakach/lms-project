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
        Schema::dropIfExists('projects');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
            $table->id();
            $table->foreignId('stundent_id')->constrained('users')->onDelete('cascade');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('file_path')->nullable();
            $table->enum('status', ['Submitted', 'Reviewed', 'Approved', 'Rejected'])->default('Submitted');
            $table->text('feedback')->nullable();
            $table->timestamp('submission_date')->nullable();
            $table->timestamps();
    }
};
