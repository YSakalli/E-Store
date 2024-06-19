<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use App\Models\User;
use App\Models\Cart;
class User extends Authenticatable
{
    use HasRoles;
    protected $fillable = [
        'name', 'email', 'password','card_id',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function cart()
{
    return $this->belongsTo(Cart::class, 'cart_id');
}
}

