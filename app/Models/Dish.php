<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dish extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function restaurant() {
        return $this->belongsTo(Restaurant::class);
    }
    public function orders() {
        return $this->belongsToMany(Order::class);
    }
    public function category() {
        return $this->belongsTo(Category::class);
    }

    // public function getRouteKeyName()
    // {
    //     return 'dish_slug';
    // }

    protected $fillable = ['restaurant_id', 'dish_name', 'dish_slug', 'category_id', 'dish_photo', 'is_visible', 'price', 'description', 'is_vegetarian'];
}
