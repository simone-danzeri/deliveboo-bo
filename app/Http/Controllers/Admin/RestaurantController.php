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
    public function show(Restaurant $restaurant)
    {   
        return view('admin.projects.show', compact('restaurant'));
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
        return view('admin.restaurants.edit', compact('restaurant', 'types', 'user'));
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
                'img' => 'nullable|image|max:254',
                'type_name' => 'nullable|exists:types,id',
                'email' => 'nullable|email'
            ]
        );
        // Validation
        $formData = $request->all();
        if ($request->hasFile('img')) {
            if($restaurant->img) {
                Storage::delete($restaurant->img);
            }
            $img_path = Storage::disk('public')->put('restaurants', $formData['img']);
            $formData['img'] = $img_path;
        };
        $restaurant['slug'] = Str::slug($formData['restaurant_name'], '-');
        $restaurant->update($formData);
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
