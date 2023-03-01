<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
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
        'username',
        'firstname',
        'lastname',
        'email',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function fullName(){
        return $this->firstname.' '.$this->lastname;
    }

    public function cart(){
        return $this->hasOne(Cart::class);
    }

    public function addresses(){
        return $this->belongsToMany(Address::class,'user_addresses');
    }

    public function userAddresses(){
        return $this->hasMany(UserAddress::class);
    }

    public function billingAddress(){
        foreach ($this->userAddresses as $user_address) {
            if($user_address->user_address_is_billing)
                return $user_address->address;
        }
        return null;
    }
    public function shippingAddress(){
        foreach ($this->userAddresses as $user_address) {
            if($user_address->user_address_is_shipping)
                return $user_address->address;
        }
        return null;
    }
    public function orders(){
        return $this->hasMany(Order::class);
    }
}
