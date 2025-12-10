<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CourseVideo;

class VideoCompletion extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'video_id', 'is_completed'];

    public function video()
    {
        return $this->belongsTo(CourseVideo::class);
    }

}
