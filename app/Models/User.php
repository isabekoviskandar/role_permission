<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'role',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
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
    public function roles(){
        return $this->belongsToMany(Role::class,'user_roles','user_id','role_id');
    }


    public function hasPermission($permission): bool
    {
        return $this->roles()->whereHas('permissions', function ($query) use ($permission) {
            $query->where('key', $permission);
        })->exists();
    }

    protected static function booted()
{
    static::created(function ($user) {
        // Assign default role, e.g., "user" with `role_id` of 2
        $user->roles()->attach(2);
    });
}

    
    
}
