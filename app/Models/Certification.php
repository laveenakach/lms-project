<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certification extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id', 'title', 'description', 'file_path', 'issued_date',
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}
