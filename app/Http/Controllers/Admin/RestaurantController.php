<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Type;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $restaurants = Restaurant::all()->where('user_id', '=', $user->id);
        //dd($restaurants);
        return view('admin.restaurants.index', compact('restaurants', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $types = Type::all();

        return view('admin.restaurants.create', compact( 'user', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Restaurant $restaurant)
    {
        $request->validate([
            'restaurant_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'vat_number' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'img' => 'nullable|image|max:2048',
            'types' => 'exists:types,id'
        ]);

        $formData = $request->all();
        
        if ($request->hasFile('img')) {
            $img_path = Storage::disk('public')->put('cover_restaurant', $formData['img']);
            $formData['img'] = $img_path;
        };
        
        $user = Auth::user();
        $newRestaurant = new Restaurant();
        $newRestaurant->fill($formData);
        $newRestaurant['slug'] = Str::slug($formData['restaurant_name'], '-');
        $newRestaurant->user_id = $user->id;
        $newRestaurant->save();

        //gestione checkboxes types
        if($request->has('types')) {
            $newRestaurant->types()->attach($formData['types']); 
        }

        session()->flash('message', 'Restaurant successfully created.');

        return redirect()->route('admin.restaurants.show', ['restaurant' => $newRestaurant->slug]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Restaurant $restaurant)
    {
        $user = Auth::user();
        if ($restaurant->user_id == $user->id){
            return view('admin.restaurants.show', compact('restaurant', 'user'));
        } else {
            return view('admin.negate', compact('user'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Restaurant $restaurant)
    {
        $types = Type::all();
        $user = Auth::user();
        if ($restaurant->user_id == $user->id){
            return view('admin.restaurants.edit', compact('restaurant', 'types', 'user'));
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
    public function update(Request $request, Restaurant $restaurant)
    {
        // Validation
        $request->validate(
            [
                'restaurant_name' => [
                    'required',
                    'max:249',
                    Rule::unique('restaurants')->ignore($restaurant->id)
                ],
                'address' => 'required',
                'phone' => 'nullable|max:20',
                'img' => 'nullable|image|max:255',
                'type_name' => 'nullable|exists:types,id',
                'email' => 'nullable|email',
                'types' => 'exists:types,id'
            ]
        );
        // Validation
        $formData = $request->all();
        
        if ($request->hasFile('img')) {
            if($restaurant->img) {
                Storage::delete($restaurant->img);
            }
            $img_path = Storage::disk('public')->put('cover_restaurant', $formData['img']);
            $formData['img'] = $img_path;
        } elseif ($request->has('delete-img')){
            $formData['dish_photo'] = null;
        };
        $restaurant['slug'] = Str::slug($formData['restaurant_name'], '-');
        $restaurant->update($formData);

        // Gestione checkboxes types
        if($request->has('types')) {
            $restaurant->types()->sync($formData['types']); 
        }else{
            $restaurant->types()->sync([]);
        }

        session()->flash('message', 'Restaurant successfully edited.');

        return redirect()->route('admin.restaurants.show', ['restaurant' => $restaurant->slug]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restaurant $restaurant)
    {
        $restaurant->delete();

        // return redirect()->route('admin.projects.index');
    }
}
