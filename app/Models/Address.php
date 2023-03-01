<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_addresses');
    }

    public function userAddresses()
    {
        return $this->hasMany(UserAddress::class);
    }

    public function isDefaultAddress(User $user)
    {
        $user_address = UserAddress::where('address_id', $this->id)->where('user_id', $user->id)->get();
        return $user_address != null;
    }

}
