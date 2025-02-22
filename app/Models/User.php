<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable , HasRoles;
    use SoftDeletes;
    /**
      * Récupère le profil associé à cet utilisateur.
      *
      * Cette méthode définit une relation "hasOne" entre l'utilisateur et son profil.
      * Elle permet d'obtenir les informations du profil correspondant via $user->profile.
      *
      * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
    /**
     * Relation avec le modèle Company.
     *
     * Un utilisateur peut posséder plusieurs companies.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function companies(): HasMany
    {
        return $this->hasMany(Company::class);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'handle',
        'is_active',
        'created_at',
        'role'
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
 
}
