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
        $dishes = Dish::where('restaurant_id', '=', $restaurant)->get();
        return response()->json([
            "success" => true,
            "results" => $dishes
        ]);
    }
}
