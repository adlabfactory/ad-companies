<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Feature extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['feature_name', 'description'];

    /**
     * Relation Many-to-Many avec Pack.
     */
    public function packs()
    {
        return $this->belongsToMany(Pack::class, 'pack_feature')
                    ->withPivot('is_enabled')
                    ->withTimestamps();
    }
}
