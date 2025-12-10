<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Assignment;
use App\Notifications\AssignmentDeadlineNotification;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule): void
    {
        $schedule->call(function () {

            $assignments = Assignment::whereDate('submission_date', now())->get();

            foreach ($assignments as $assignment) {

                $student = User::where('id', $assignment->student_id)
                    ->where('role', 'student')
                    ->first();

                if (!$student) continue;

                // Skip if already submitted
                if ($student->hasSubmitted($assignment->id)) continue;

                // ------------------------------
                // Prevent duplicate email
                // ------------------------------
                $alreadySent = DB::table('email_logs')
                    ->where('user_id', $student->id)
                    ->where('assignment_id', $assignment->id)
                    ->exists();

                if (!$alreadySent) {
                    // Send email + Laravel notification
                    $student->notify(new AssignmentDeadlineNotification($assignment));

                    // Log email to prevent duplicate
                    DB::table('email_logs')->insert([
                        'user_id' => $student->id,
                        'assignment_id' => $assignment->id,
                        'created_at' => now(),
                    ]);
                }

                // ------------------------------
                // Insert into custom notifications table
                // ------------------------------
                $duplicateWeb = DB::table('notifications')
                    ->where('title', 'Assignment Deadline')
                    ->where('message', "Assignment '{$assignment->title}' is due today!")
                    ->where('date', today())
                    ->where('target_role', 'student')
                    ->exists();

                if (!$duplicateWeb) {
                    // Insert notification
                    $notificationId = DB::table('notifications')->insertGetId([
                        'title' => 'Assignment Deadline', // must exist
                        'message' => "Assignment '{$assignment->title}' is due today!",
                        'date' => now()->toDateString(),
                        'attachment' => null,
                        'created_by' => 1,
                        'is_read' => 0,
                        'target_role' => 'student',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    // Attach to pivot table
                    DB::table('user_notifications')->insert([
                        'user_id' => $student->id,
                        'notification_id' => $notificationId,
                        'is_read' => false,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }

            }

        })->everyMinute();
    }

    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}
