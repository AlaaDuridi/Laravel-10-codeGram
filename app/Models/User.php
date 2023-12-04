<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'avatar',
        'password',
    ];

    /**
     * @var array<int, string>
     * MASS ASSIGNMENT
     *
     * try making all the attributes guarder, and trust the user.
     * here, if you go and tried in tinker to update anything, it will be accepted
     */

    // protected $guarded = [];


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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * @todo $user = User::create(['name'=>'ruba','email'=>'ruba@sheikh' , 'password'=>'hiba'])
     */
    protected function password(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => bcrypt($value)
        );
    }
    /**
     * @todo dd($user->name);
     */
    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Str::upper($value)
        );
        //Str -- laravel
        // strtoupper -- php
    }

    /**
     * @todo define relationships
     */
    /**
     * Get the phone associated with the user
     */

    public function phone(): HasOne
    {
        return $this->hasOne(Phone::class);
    }

    //Get posts associated with the user
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}
