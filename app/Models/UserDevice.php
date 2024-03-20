<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;

class UserDevice extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'user_devices';
    protected $fillable = ['user_id', 'device_uuid', 'push_token'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function routeNotificationForFcm()
    {
        return $this->push_token;
    }
}
