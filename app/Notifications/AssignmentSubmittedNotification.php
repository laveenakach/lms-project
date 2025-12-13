<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Assignment;
use App\Models\User;

class AssignmentSubmittedNotification extends Notification
{
    use Queueable;

    protected $assignment;
    protected $student;

    /**
     * Create a new notification instance.
     */
    public function __construct(Assignment $assignment, User $student)
    {
        $this->assignment = $assignment;
        $this->student = $student;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable)
    {
        return ['mail', 'database']; // sends email + stores in notifications table
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('New Assignment Submission')
            ->line("Student {$this->student->name} submitted '{$this->assignment->title}'.")
            ->action('View Assignment', url('/trainer/assignments/' . $this->assignment->id))
            ->line('Please check the submission.');
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => 'New Assignment Submission',
            'message' => "Student {$this->student->name} submitted '{$this->assignment->title}'.",
            'assignment_id' => $this->assignment->id,
            'target_role' => 'trainer',
        ];
    }
}
