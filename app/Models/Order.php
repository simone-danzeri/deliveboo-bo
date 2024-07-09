<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public function dishes() {
        return $this->belongsToMany(Dish::class);
    }
    public function restaurant() {
        return $this->belongsTo(Restaurant::class);
    }

    protected $fillable = ['client_name', 'client_surname', 'address',  'phone', 'email', 'total', 'restaurant_id'];
}
