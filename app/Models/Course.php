<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Invoice;
use App\Models\Assignment;
use App\Models\Project;
use App\Models\VideoCompletion;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['trainer_id', 'student_id', 'title', 'description', 'thumbnail', 'status','course_fee'];

    // ✅ Corrected relationship to CourseVideo model
    public function videos()
    {
        return $this->hasMany(CourseVideo::class, 'course_id');
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class, 'course_id');
    }

    public function projects()
    {
        return $this->hasMany(Project::class, 'course_id');
    }

    public function trainer()
    {
        return $this->belongsTo(User::class, 'trainer_id');
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function enrollments()
    {
        return $this->hasMany(CourseEnrollment::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function videoCompletions()
    {
        return $this->hasMany(VideoCompletion::class);
    }

}
