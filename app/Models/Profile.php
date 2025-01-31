<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Profile extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'profile_picture',
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
