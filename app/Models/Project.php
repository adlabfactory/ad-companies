<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'slug',
        'logo',
        'colors',
        'project_description',
        'estimated_budget',
        'uploaded_files',
        'project_status',
        'start_date',
        'end_date',
    ];

    protected $casts = [
        'colors' => 'array',
        'uploaded_files' => 'array',
        'start_date' => 'date',
        'end_date' => 'date',
        'estimated_budget' => 'decimal:2',
    ];

    /**
     * Relation : Un projet appartient à une entreprise (Company).
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
