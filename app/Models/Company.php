<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;


class Company extends  Authenticatable
{
    /** @use HasFactory<\Database\Factories\CompanyFactory> */

    use HasFactory, Notifiable;
    use SoftDeletes;
    protected $guard = 'company'; // Définir le guard ici

    /**
     * Les attributs pouvant être assignés en masse.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'password',
        'company_name',
        'company_category',
        'company_description',
        'company_email',
        'company_phone',
        'company_address',
        'company_rc',
        'user_id',
        'company_website_domain',
        'domain_exists',
        'contact_person_name',
        'contact_person_role',
        'subscription_start_at',
        'subscription_end_at',
        'status',
        'devis_status',
        'logo',
    ];

    /**
     * Les attributs qui doivent être cachés pour les tableaux.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Les attributs qui doivent être castés.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'domain_exists'        => 'boolean',
        'subscription_start_at' => 'datetime',
        'subscription_end_at'   => 'datetime',
    ];

    /**
     * Relation avec le modèle User.
     *
     * Une Company appartient à un User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
      /**
     * Relation avec le modèle Project.
     *
     * Une Company contient plusieurs projects.
     *
    
     */
       public function projects()
   {
        return $this->hasMany(Project::class);
   }

}
