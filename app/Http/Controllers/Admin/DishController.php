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

class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($restSlug)
    {
        $restaurant = Restaurant::all()->where('slug', '=', $restSlug)->first();
        //$getRestaurant = DB::table('restaurants')->where('slug', '=', $restSlug)->get();
        //$restaurant = $getRestaurant[0];
        $user = Auth::user();
        $dishes = Dish::where('restaurant_id', '=', $restaurant['id'])->get();
        return view('admin.dishes.index', compact('user', 'dishes', 'restaurant'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Restaurant $restaurant, Dish $dish)
    {
        // dd($dish);
        $user = Auth::user();

        return view('admin.dishes.show', compact('user','restaurant','dish',));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Restaurant $restaurant, Dish $dish){
        // $types = Type::all();
        $user = Auth::user();
        $categories = Category::all();

        if($user->id == $restaurant->user_id){
            return view('admin.dishes.edit', compact('dish', 'user', 'categories', 'restaurant'));
        } else {
            return view('admin.negate', compact('user'));
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Restaurant $restaurant, Dish $dish)
    {
        // Validation
        $request->validate([
            'dish_name' => 'required|max:255',
            'dish_photo' => 'image|max:255|nullable',
            'is_visible' => 'boolean',
            'is_vegetarian' => 'boolean',
            'category_id' => 'nullable|exists:categories,id',
            'price' => 'numeric|max:999.99',
            'description' => 'nullable|max:1000'
        ]);

        $formData = $request->all();
        if ($request->hasFile('img')) {
            if($dish->dish_photo) {
                Storage::delete($restaurant->dish_photo);
            }
            $img_path = Storage::disk('public')->put('cover_dish', $formData['dish_photo']);
            $formData['dish_photo'] = $img_path;
        };
        $dish['dish_slug'] = Str::slug($formData['dish_name'], '-');
        $checkboxValueVisible = $request->has('is_visible') ? 1 : 0;
        $checkboxValueVegetarian = $request->has('is_vegetarian') ? 1 : 0;
        if(!$request->has('category_id')) {
            $formData['category_id'] = null;
        }
        $dish['is_visible'] = $checkboxValueVisible;
        $dish['is_vegetarian'] = $checkboxValueVegetarian;
        $dish->update($formData);
        return redirect()->route('admin.dishes.show', ['restaurant' => $restaurant->slug, 'dish' => $dish->dish_slug]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restaurant $restaurant, Dish $dish)
    {
        $dish->delete();
        $restSlug = $restaurant->slug;

        return redirect()->route('admin.dishes.index', $restSlug);
    }

    public function bin(Restaurant $restaurant, Dish $dish)
    {
        $user = Auth::user();
        $binDishes = Dish::onlyTrashed()
            ->whereHas('restaurant', function($query) use ($user) {
                $query->where('user_id', $user->id);
            })->get();

        return view('admin.restaurants.bin', compact('binDishes', 'user', 'restaurant'));
    }

    public function emptyBin($dish)
    {
        $delDish = Dish::onlyTrashed()->findOrFail($dish);

        $user = Auth::user();
        $delDish->forceDelete();

        return redirect()->route('admin.restaurants.bin', ['user']);
    }

    public function restoreBin($dish)
    {
        $restDish = Dish::onlyTrashed()->findOrFail($dish);

        $user = Auth::user();
        $restDish->restore();

        return redirect()->route('admin.restaurants.bin', ['user']);
    }
}
