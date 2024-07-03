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
        $slug = $request->query('slug');
        if(!$slug) {
            return response()->json([
                "success" => false,
                "results" => 'This value is invalid'
            ]);
        };
        $restaurant = Restaurant::where('slug', '=', $slug)->first();
        $dishes = $restaurant->dishes->where('is_visible', '=', true);
            if(count($dishes) == 0) {
                return response()->json([
                    "success" => false,
                    "results" => "No dishes exists for this restaurant or this restaurant doesn't exists"
                ]);
            } else {
                return response()->json([
                    "success" => true,
                    "results" => $dishes
                ]);
            }
}
}
