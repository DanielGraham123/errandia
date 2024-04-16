<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAnnouncement extends Model
{
    use HasFactory;

    protected $table = 'user_announcements';
    protected $fillable = ['user_id', 'announcement_id', 'deleted'];
}
