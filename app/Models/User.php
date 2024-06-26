<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'address',
        'phoneNumber',
        'avatar'
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

    

    public function appointmens(){
        return $this->hasMany(Appointment::class);
    }


    public function notifications(){
        return $this->hasMany(Notification::class);
    }

    public function repairs()
    {
        return $this->hasMany(Repair::class);
    }

    public function emails()
    {
        return $this->hasMany(SentEmail::class);
    }

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }


    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'mechanic_tasks')->withTimestamps();
    }
}
