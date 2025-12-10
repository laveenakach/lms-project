<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'message',
        'date',
        'attachment',
        'created_by',
        'target_role',
        'is_read',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function users()
    {
        return $this->belongsToMany(\App\Models\User::class, 'user_notifications')
            ->withPivot('is_read')
            ->withTimestamps();
    }
}
