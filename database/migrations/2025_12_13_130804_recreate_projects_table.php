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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();

            // 🔥 Link assignment to a specific course
            $table->foreignId('course_id')
                  ->constrained('courses')
                  ->onDelete('cascade');

            // 🔥 Trainer who created the assignment
            $table->foreignId('trainer_id')
                  ->constrained('users')
                  ->onDelete('cascade');

            $table->string('title');
            $table->text('description')->nullable();

            // File the trainer uploads for the assignment instructions
            $table->string('file_path')->nullable();

            // Status based on submission checking
            $table->enum('status', ['Assigned','Pending', 'Submitted', 'Checked', 'Approved', 'Rejected'])
                  ->default('Pending');

            $table->text('feedback')->nullable();
            $table->timestamp('submission_date')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
