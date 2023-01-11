<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, SoftDeletes, HasApiTokens, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'name',
        'email',
        'password',
        'address',
        'phone',
        'created_at',
    ];

    public function reservation()
    {
        return $this->hasMany(Reservation::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function review()
    {
        return $this->hasMany(Review::class);
    }
    
    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }
}
