<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pack extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['pack_name', 'price', 'duration'];

    /**
     * Relation Many-to-Many avec Feature.
     */
    public function features()
    {
        return $this->belongsToMany(Feature::class, 'pack_feature')
                    ->withPivot('is_enabled')
                    ->withTimestamps();
    }
}