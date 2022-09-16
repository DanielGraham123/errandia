<?php


namespace Modules\User\Entities;


use Illuminate\Database\Eloquent\Model;
use Modules\Street\Entities\Street;

class UserProfile extends Model
{
    protected $table = "user_profiles";
    protected $fillable = ['user_id', 'gender', 'street_id', 'pob', 'dob', 'categories_interest'];

    public function street()
    {
        return $this->belongsTo(Street::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
