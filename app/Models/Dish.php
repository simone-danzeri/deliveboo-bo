<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    use HasFactory;

    public function restaurant() {
        return $this->belongsTo(Restaurant::class);
    }
    public function orders() {
        return $this->belongsToMany(Order::class);
    }
    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected $fillable = ['restaurant_id', 'dish_name', 'dish_slug', 'category_id', 'dish_photo', 'is_visible', 'price', 'description', 'is_vegetarian'];
}
