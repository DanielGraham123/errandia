<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Announcement extends Model
{
    use HasFactory;

    protected $table = 'announcements';
    protected $fillable = ['title', 'message', 'published'];

    public function readers(): HasManyThrough
    {
        return $this->hasManyThrough(
            User::class,
            UserAnnouncement::class,
            'announcement_id',
            'id',
            'id',
            'user_id'
        );
    }
}
