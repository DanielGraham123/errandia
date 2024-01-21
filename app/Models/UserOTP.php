<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserOTP extends Model
{
    use HasFactory;

    protected $table = 'user_otps';

    protected $fillable = ['uuid', 'user_id', 'code', 'expired_date'];

    public function user()
    {
        return $this->belongsTo(User::class)->first();
    }
}
