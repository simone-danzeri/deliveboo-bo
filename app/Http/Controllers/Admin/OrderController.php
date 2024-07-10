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
use App\Models\Order;

class OrderController extends Controller
{
    public function index(Restaurant $restaurant) {
        $user = Auth::user();
        $orders = Order::where('restaurant_id', '=', $restaurant['id'])->get();
        

        if($user->id == $restaurant->user_id){
            return view('admin.orders.index', compact('restaurant', 'user', 'orders'));
        } else {
            return view('admin.negate', compact('user'));
        }
    }
    public function userInfo(Restaurant $restaurant, Order $order) {
        $user = Auth::user();
        return view('admin.orders.user-info', compact('restaurant', 'dish', 'user'));
    }
}
