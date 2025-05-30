<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

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
        'password',
        'tiktok_token',
        'tiktok_refresh_token',
        'tiktok_token_expiry',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->hasOne('App\Models\Role', 'id', 'role_id');
    }

    function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function userPackage()
    {
        return $this->hasOne('App\Models\UserPackage', 'id', 'user_id');
    }

    
    public function ads()
    {
        return $this->hasMany('App\Models\Ads', 'user_id', 'id');
    }

    public function medias()
    {
        return $this->hasMany('App\Models\Media', 'user_id', 'id');
    }

    public function getWallet(){
        return number_format($this->wallet, 2);
    }
}
