<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\VideoCompletion;

class CourseEnrollment extends Model
{
    use HasFactory;

    protected $fillable = ['course_id', 'student_id', 'status'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function completions()
    {
        return $this->hasMany(VideoCompletion::class, 'student_id', 'video_id');
    }

}
