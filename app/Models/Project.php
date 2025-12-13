<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Course;

class Project extends Model
{
    use HasFactory;

     protected $fillable = [
        'course_id',
        'trainer_id',
        'title',
        'description',
        'submission_date',
        'file_path',
        'status',
        'feedback',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function trainer()
    {
        return $this->belongsTo(User::class, 'trainer_id');
    }
}
