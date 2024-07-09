<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Restaurant;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use App\Models\Type;
use App\Models\Category;
use App\Models\Dish;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    public function index(Restaurant $restaurant, Dish $dish) {
        $user = Auth::user();
        return view('admin.orders.index', compact('restaurant', 'dish', 'user'));
    }
    public function userInfo(Restaurant $restaurant, Dish $dish) {
        $user = Auth::user();
        return view('admin.orders.user-info', compact('restaurant', 'dish', 'user'));
    }
}
