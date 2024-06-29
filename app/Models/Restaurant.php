<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;
    public function user() {
        return $this->belongsTo(User::class);
    }

    protected $fillable = ['restaurant_name', 'slug', 'address', 'img', 'phone', 'email','vat_number'];


    public function types() {
        return $this->belongsToMany(Type::class);
    }
    public function dishes() {
        return $this->hasMany(Dish::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
