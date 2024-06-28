<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class RestaurantController extends Controller
{
    public function index() {
        $restaurants = Restaurant::all();
        return response()->json([
            "success" => true,
            "results" => $restaurants
        ]);
    }
}
