<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Dish;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class DishController extends Controller
{
    public function index(Request $request) {
        $restaurant = $request->query('restaurant');
        if(!$restaurant || !is_numeric($restaurant)) {
            return response()->json([
                "success" => false,
                "results" => 'This value is invalid'
            ]);
        };
        $dishes = Dish::where('restaurant_id', '=', $restaurant)->where('is_visible', '=', true)->get();
        if(count($dishes) == 0) {
            return response()->json([
                "success" => false,
                "results" => "No dishes exists for this restaurant or this restaurant doesn't exists"
            ]);
        }  else {
            return response()->json([
                "success" => true,
                "results" => $dishes
            ]);
    }

}
}
